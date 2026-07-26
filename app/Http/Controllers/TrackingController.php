<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackingController extends Controller
{
    /**
     * Handle tracking number submission and display results.
     */
    public function track(Request $request): View
    {
        $request->validate([
            'tracking_number' => ['required', 'string'],
        ]);

        $trackingNumber = $request->input('tracking_number');
        $shipment = Shipment::where('tracking_number', $trackingNumber)->first();

        $trackingEvents = $shipment ? $shipment->trackingEvents : null;

        return view('pages.track-a-parcel', [
            'shipment' => $shipment,
            'trackingEvents' => $trackingEvents,
            'trackingNumber' => $trackingNumber,
        ]);
    }

    /**
     * Display tracking results for a given tracking number via GET.
     */
    public function show(Request $request, string $trackingNumber): View
    {
        $shipment = Shipment::where('tracking_number', $trackingNumber)->first();

        $trackingEvents = $shipment ? $shipment->trackingEvents : null;

        return view('pages.track-a-parcel', [
            'shipment' => $shipment,
            'trackingEvents' => $trackingEvents,
            'trackingNumber' => $trackingNumber,
        ]);
    }
}
