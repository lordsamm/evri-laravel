<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentTrackingRequest;
use App\Http\Requests\UpdateShipmentTrackingRequest;
use App\Models\Shipment;
use App\Models\ShipmentTracking;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShipmentTrackingController extends Controller
{
    /**
     * Display a listing of tracking events for a shipment.
     */
    public function index(Shipment $shipment): View
    {
        $trackingEvents = $shipment->trackingEvents()->get();

        return view('shipment-trackings.index', compact('shipment', 'trackingEvents'));
    }

    /**
     * Show the form for creating a new tracking event.
     */
    public function create(Shipment $shipment): View
    {
        return view('shipment-trackings.create', [
            'shipment' => $shipment,
            'trackingEvent' => new ShipmentTracking([
                'event_datetime' => now(),
            ]),
        ]);
    }

    /**
     * Store a newly created tracking event in storage.
     */
    public function store(StoreShipmentTrackingRequest $request, Shipment $shipment): RedirectResponse
    {
        $trackingEvent = $shipment->trackingEvents()->create($request->validated());

        return redirect()
            ->route('admin.shipments.trackings.index', $shipment)
            ->with('success', 'Tracking event added successfully.');
    }

    /**
     * Display the specified tracking event.
     */
    public function show(Shipment $shipment, ShipmentTracking $trackingEvent): View
    {
        return view('shipment-trackings.show', compact('shipment', 'trackingEvent'));
    }

    /**
     * Show the form for editing the specified tracking event.
     */
    public function edit(Shipment $shipment, ShipmentTracking $trackingEvent): View
    {
        return view('shipment-trackings.edit', compact('shipment', 'trackingEvent'));
    }

    /**
     * Update the specified tracking event in storage.
     */
    public function update(UpdateShipmentTrackingRequest $request, Shipment $shipment, ShipmentTracking $trackingEvent): RedirectResponse
    {
        $trackingEvent->update($request->validated());

        return redirect()
            ->route('admin.shipments.trackings.index', $shipment)
            ->with('success', 'Tracking event updated successfully.');
    }

    /**
     * Remove the specified tracking event from storage.
     */
    public function destroy(Shipment $shipment, ShipmentTracking $trackingEvent): RedirectResponse
    {
        $trackingEvent->delete();

        return redirect()
            ->route('admin.shipments.trackings.index', $shipment)
            ->with('success', 'Tracking event deleted successfully.');
    }
}
