<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentProofRequest;
use App\Models\PaymentProof;
use App\Models\Shipment;
use App\Models\ShipmentFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PaymentProofController extends Controller
{
    public function create(Shipment $shipment, ShipmentFee $fee): View
    {
        abort_unless($fee->shipment_id === $shipment->id, 404);

        $fee->load('shipment');
        return view('payment-proofs.create', compact('fee'));
    }

    public function store(StorePaymentProofRequest $request, Shipment $shipment, ShipmentFee $fee): RedirectResponse
    {
        abort_unless($fee->shipment_id === $shipment->id, 404);

        $receiptPath = $request->file('receipt')->store('payment-proofs', 'public');

        $fee->paymentProof()->create([
            'payer_name' => $request->payer_name,
            'payment_reference' => $request->payment_reference,
            'receipt_path' => $receiptPath,
            'note' => $request->note,
        ]);

        return redirect()
            ->route('tracking.show', $fee->shipment->tracking_number)
            ->with('success', 'Payment proof submitted successfully. Awaiting verification.');
    }

    public function index(): View
    {
        $proofs = PaymentProof::with('shipmentFee.shipment')->latest()->paginate(15);

        return view('payment-proofs.index', compact('proofs'));
    }

    public function show(PaymentProof $payment_proof): View
    {
        $payment_proof->load('shipmentFee.shipment');

        return view('payment-proofs.show', ['proof' => $payment_proof]);
    }

    public function verify(PaymentProof $payment_proof): RedirectResponse
    {
        $payment_proof->update(['status' => PaymentProof::STATUS_VERIFIED]);
        $payment_proof->shipmentFee->update(['status' => ShipmentFee::STATUS_PAID]);
        
        // Update shipment payment status if all fees are paid
        $shipment = $payment_proof->shipmentFee->shipment;
        $allFeesPaid = $shipment->fees()->where('status', ShipmentFee::STATUS_PAID)->count() === $shipment->fees()->count();
        if ($allFeesPaid) {
            $shipment->update(['payment_status' => Shipment::PAYMENT_PAID]);
        }

        return redirect()
            ->route('admin.payment-proofs.show', $payment_proof)
            ->with('success', 'Payment proof verified successfully. Fee marked as paid.');
    }

    public function reject(PaymentProof $payment_proof): RedirectResponse
    {
        $payment_proof->update(['status' => PaymentProof::STATUS_REJECTED]);

        return redirect()
            ->route('admin.payment-proofs.show', $payment_proof)
            ->with('success', 'Payment proof rejected successfully.');
    }
}
