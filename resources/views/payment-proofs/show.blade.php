@extends('layouts.admin')

@section('title', 'Payment Proof - '.$proof->payer_name)

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Payment Proof Details</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.payment-proofs.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Shipment</strong>
                <a href="{{ route('admin.shipments.show', $proof->shipmentFee->shipment) }}">{{ $proof->shipmentFee->shipment->tracking_number }}</a>
            </div>
            <div class="detail-item">
                <strong>Fee</strong>
                {{ $proof->shipmentFee->fee_name }} (£{{ number_format($proof->shipmentFee->amount, 2) }})
            </div>
            <div class="detail-item">
                <strong>Payer Name</strong>
                {{ $proof->payer_name }}
            </div>
            <div class="detail-item">
                <strong>Payment Reference</strong>
                {{ $proof->payment_reference ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Status</strong>
                @if ($proof->status === 'pending')
                    <span class="badge bg-warning">Pending</span>
                @elseif ($proof->status === 'verified')
                    <span class="badge bg-success">Verified</span>
                @else
                    <span class="badge bg-danger">Rejected</span>
                @endif
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Note</strong>
                {{ $proof->note ?? '—' }}
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Receipt</strong>
                <div style="margin-top: 0.5rem;">
                    <img src="{{ asset('storage/' . $proof->receipt_path) }}" alt="Receipt" style="max-width: 100%; max-height: 400px; border: 1px solid #dee2e6; border-radius: 4px;">
                </div>
            </div>
            <div class="detail-item">
                <strong>Submitted</strong>
                {{ $proof->created_at->format('d M Y H:i') }}
            </div>
            <div class="detail-item">
                <strong>Last Updated</strong>
                {{ $proof->updated_at->format('d M Y H:i') }}
            </div>
        </div>
    </div>
</div>
@endsection
