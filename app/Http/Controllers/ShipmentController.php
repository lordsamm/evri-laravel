<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $shipments = Shipment::query()
            ->latest()
            ->paginate(15);

        return view('shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('shipments.create', [
            'shipment' => new Shipment([
                'current_status' => Shipment::STATUS_PENDING,
                'payment_status' => Shipment::PAYMENT_UNPAID,
                'shipping_cost' => 0,
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShipmentRequest $request): RedirectResponse
    {
        $shipment = Shipment::query()->create($request->validated());

        return redirect()
            ->route('admin.shipments.show', $shipment)
            ->with('success', 'Shipment created successfully. Tracking number: '.$shipment->tracking_number);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment): View
    {
        $shipment->load([
            'originCountry',
            'destinationCountry',
            'trackingEvents' => fn($query) => $query->chronological(),
            'fees',
            'documents',
        ]);

        return view('shipments.show', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment): View
    {
        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment): RedirectResponse
    {
        $shipment->update($request->validated());

        return redirect()
            ->route('admin.shipments.show', $shipment)
            ->with('success', 'Shipment updated successfully.');
    }
}
