<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShipmentFeeRequest;
use App\Http\Requests\UpdateShipmentFeeRequest;
use App\Models\Shipment;
use App\Models\ShipmentFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShipmentFeeController extends Controller
{
    public function index(Shipment $shipment): View
    {
        $fees = $shipment->fees()->latest()->paginate(15);

        return view('shipment-fees.index', compact('shipment', 'fees'));
    }

    public function create(Shipment $shipment): View
    {
        return view('shipment-fees.create', compact('shipment'));
    }

    public function store(StoreShipmentFeeRequest $request, Shipment $shipment): RedirectResponse
    {
        $fee = $shipment->fees()->create($request->validated());

        return redirect()
            ->route('admin.shipments.fees.show', [$shipment, $fee])
            ->with('success', 'Fee created successfully.');
    }

    public function show(Shipment $shipment, ShipmentFee $fee): View
    {
        return view('shipment-fees.show', compact('shipment', 'fee'));
    }

    public function edit(Shipment $shipment, ShipmentFee $fee): View
    {
        return view('shipment-fees.edit', compact('shipment', 'fee'));
    }

    public function update(UpdateShipmentFeeRequest $request, Shipment $shipment, ShipmentFee $fee): RedirectResponse
    {
        $fee->update($request->validated());

        return redirect()
            ->route('admin.shipments.fees.show', [$shipment, $fee])
            ->with('success', 'Fee updated successfully.');
    }

    public function destroy(Shipment $shipment, ShipmentFee $fee): RedirectResponse
    {
        $fee->delete();

        return redirect()
            ->route('admin.shipments.fees.index', $shipment)
            ->with('success', 'Fee deleted successfully.');
    }
}
