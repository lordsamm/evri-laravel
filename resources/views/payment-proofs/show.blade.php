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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($proof->status === 'pending')
                <div class="mb-3">
                    <form action="{{ route('admin.payment-proofs.verify', $proof) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success me-2" onclick="return confirm('Are you sure you want to verify this payment proof? This will mark the fee as paid.')">
                            Verify Payment
                        </button>
                    </form>
                    <form action="{{ route('admin.payment-proofs.reject', $proof) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this payment proof?')">
                            Reject Payment
                        </button>
                    </form>
                </div>
            @endif

            <div class="detail-grid">
                <div class="detail-item">
                    <strong>Tracking Number</strong>
                    @if($proof->shipmentFee && $proof->shipmentFee->shipment)
                        <a href="{{ route('admin.shipments.show', $proof->shipmentFee->shipment) }}">{{ $proof->shipmentFee->shipment->tracking_number }}</a>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </div>
                <div class="detail-item">
                    <strong>Fee Name</strong>
                    {{ $proof->shipmentFee->fee_name ?? '—' }}
                </div>
                <div class="detail-item">
                    <strong>Fee Amount</strong>
                    {{ $proof->shipmentFee ? '£' . number_format($proof->shipmentFee->amount, 2) : '—' }}
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
                <div class="detail-item">
                    <strong>Submitted Date</strong>
                    {{ $proof->created_at?->format('d M Y H:i') ?? '—' }}
                </div>
                <div class="detail-item">
                    <strong>Last Updated</strong>
                    {{ $proof->updated_at?->format('d M Y H:i') ?? '—' }}
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
            </div>
        </div>
    </div>
</div>
@endsection
