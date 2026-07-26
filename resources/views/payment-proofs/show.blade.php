@extends('layouts.admin')

@section('title', 'Payment Proof - '.$proof->payer_name)

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Payment Proof Details</h2>
        <a href="{{ route('admin.payment-proofs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-4">
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
                    <span>
                        @if($proof->shipmentFee && $proof->shipmentFee->shipment)
                            <a href="{{ route('admin.shipments.show', $proof->shipmentFee->shipment) }}">{{ $proof->shipmentFee->shipment->tracking_number }}</a>
                        @else
                            —
                        @endif
                    </span>
                </div>
                <div class="detail-item">
                    <strong>Fee Name</strong>
                    <span>{{ $proof->shipmentFee->fee_name ?? '—' }}</span>
                </div>
                <div class="detail-item">
                    <strong>Fee Amount</strong>
                    <span>{{ $proof->shipmentFee ? '£' . number_format($proof->shipmentFee->amount, 2) : '—' }}</span>
                </div>
                <div class="detail-item">
                    <strong>Payer Name</strong>
                    <span>{{ $proof->payer_name }}</span>
                </div>
                <div class="detail-item">
                    <strong>Payment Reference</strong>
                    <span>{{ $proof->payment_reference ?? '—' }}</span>
                </div>
                <div class="detail-item">
                    <strong>Status</strong>
                    <span>
                        @if ($proof->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif ($proof->status === 'verified')
                            <span class="badge badge-success">Verified</span>
                        @else
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </span>
                </div>
                <div class="detail-item">
                    <strong>Submitted Date</strong>
                    <span>{{ $proof->created_at?->format('d M Y H:i') ?? '—' }}</span>
                </div>
                <div class="detail-item">
                    <strong>Last Updated</strong>
                    <span>{{ $proof->updated_at?->format('d M Y H:i') ?? '—' }}</span>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <strong>Note</strong>
                    <span>{{ $proof->note ?? '—' }}</span>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <strong>Receipt</strong>
                    <div style="margin-top: 0.5rem;">
                        <img src="{{ asset('storage/' . $proof->receipt_path) }}" alt="Receipt" style="max-width: 100%; max-height: 400px; border: 1px solid var(--gray-200); border-radius: var(--radius-lg);">
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
