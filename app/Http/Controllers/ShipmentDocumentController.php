<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentDocument;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShipmentDocumentController extends Controller
{
    /**
     * Display the documents index for a shipment.
     */
    public function index(Shipment $shipment): View
    {
        $documents = $shipment->documents()->with('uploader')->latest()->get();
        return view('shipment-documents.index', compact('shipment', 'documents'));
    }

    /**
     * Show the form for uploading a new document.
     */
    public function create(Shipment $shipment): View
    {
        $documentTypes = ShipmentDocument::documentTypeOptions();
        return view('shipment-documents.create', compact('shipment', 'documentTypes'));
    }

    /**
     * Store a newly uploaded document.
     */
    public function store(Request $request, Shipment $shipment): RedirectResponse
    {
        $validated = $request->validate([
            'document_name' => 'required|string|max:255',
            'document_type' => 'required|in:' . implode(',', array_keys(ShipmentDocument::documentTypeOptions())),
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('shipment-documents', $fileName, 'public');

        ShipmentDocument::create([
            'shipment_id' => $shipment->id,
            'document_name' => $validated['document_name'],
            'document_type' => $validated['document_type'],
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.shipments.documents.index', $shipment)
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Preview a document.
     */
    public function preview(Shipment $shipment, ShipmentDocument $document): View
    {
        $this->authorizeDocumentAccess($document);
        return view('shipment-documents.preview', compact('document'));
    }

    /**
     * Download a document.
     */
    public function download(Shipment $shipment, ShipmentDocument $document): StreamedResponse
    {
        $this->authorizeDocumentAccess($document);
        
        return Storage::disk('public')->download($document->file_path, $document->document_name . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION));
    }

    /**
     * Show the form for replacing a document.
     */
    public function edit(Shipment $shipment, ShipmentDocument $document): View
    {
        $this->authorizeDocumentAccess($document);
        $documentTypes = ShipmentDocument::documentTypeOptions();
        return view('shipment-documents.edit', compact('document', 'documentTypes'));
    }

    /**
     * Replace an existing document.
     */
    public function update(Request $request, Shipment $shipment, ShipmentDocument $document): RedirectResponse
    {
        $this->authorizeDocumentAccess($document);

        $validated = $request->validate([
            'document_name' => 'required|string|max:255',
            'document_type' => 'required|in:' . implode(',', array_keys(ShipmentDocument::documentTypeOptions())),
            'file' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
        ]);

        // Delete old file if new file is uploaded
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file_path);
            
            $file = $request->file('file');
            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('shipment-documents', $fileName, 'public');

            $document->file_path = $filePath;
            $document->file_size = $file->getSize();
            $document->mime_type = $file->getMimeType();
        }

        $document->document_name = $validated['document_name'];
        $document->document_type = $validated['document_type'];
        $document->uploaded_by = Auth::id();
        $document->save();

        return redirect()
            ->route('admin.shipments.documents.index', $shipment)
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Delete a document.
     */
    public function destroy(Shipment $shipment, ShipmentDocument $document): RedirectResponse
    {
        $this->authorizeDocumentAccess($document);
        
        // Delete physical file
        Storage::disk('public')->delete($document->file_path);
        
        // Delete database record
        $document->delete();

        return redirect()
            ->route('admin.shipments.documents.index', $shipment)
            ->with('success', 'Document deleted successfully.');
    }

    /**
     * Ensure user has access to the document.
     */
    private function authorizeDocumentAccess(ShipmentDocument $document): void
    {
        // Only authenticated admins can access documents
        if (!Auth::check()) {
            abort(403, 'Unauthorized access.');
        }
    }
}
