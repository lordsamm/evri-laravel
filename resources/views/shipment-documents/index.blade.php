@extends('layouts.admin')

@section('title', 'Documents')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Documents - {{ $shipment->tracking_number }}</h2>
        <a href="{{ route('admin.shipments.documents.create', $shipment) }}" class="btn btn-primary">
            <i class="bi bi-upload me-2"></i>Upload Document
        </a>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Document Name</th>
                        <th>Document Type</th>
                        <th>File Size</th>
                        <th>Uploaded By</th>
                        <th>Uploaded Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($documents->count() > 0)
                        @foreach($documents as $document)
                        <tr>
                            <td>
                                @if($document->isPdf())
                                    <i class="bi bi-file-earmark-pdf fs-5" style="color: var(--danger);"></i>
                                @elseif($document->isImage())
                                    <i class="bi bi-file-earmark-image fs-5" style="color: var(--evri-purple-primary);"></i>
                                @else
                                    <i class="bi bi-file-earmark fs-5" style="color: var(--gray-500);"></i>
                                @endif
                            </td>
                            <td>{{ $document->document_name }}</td>
                            <td>{{ $document->document_type_label }}</td>
                            <td>{{ $document->formatted_file_size }}</td>
                            <td>{{ $document->uploader->name ?? '—' }}</td>
                            <td>{{ $document->created_at ? $document->created_at->format('M d, Y H:i') : '—' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.shipments.documents.preview', [$shipment, $document]) }}" class="btn btn-sm btn-primary" title="Preview">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.shipments.documents.download', [$shipment, $document]) }}" class="btn btn-sm btn-success" title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="{{ route('admin.shipments.documents.edit', [$shipment, $document]) }}" class="btn btn-sm btn-secondary" title="Replace">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.shipments.documents.destroy', [$shipment, $document]) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this document? This action cannot be undone.')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <p class="mb-0 text-muted">No documents uploaded yet.</p>
                                <a href="{{ route('admin.shipments.documents.create', $shipment) }}" class="btn btn-primary mt-3">Upload First Document</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
