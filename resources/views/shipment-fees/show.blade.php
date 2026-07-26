@extends('layouts.admin')

@section('title', 'Fee - '.$fee->fee_name)

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Fee Details</h2>
        <div>
            <a href="{{ route('admin.shipments.fees.edit', [$shipment, $fee]) }}" class="btn btn-primary">Edit</a>
            <form method="POST" action="{{ route('admin.shipments.fees.destroy', [$shipment, $fee]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this fee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('admin.shipments.fees.index', $shipment) }}" class="btn btn-secondary">Back to Fees</a>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-secondary">Back to Shipment</a>
        </div>
    </div>

    <div class="card p-4">
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Shipment</strong>
                <span><a href="{{ route('admin.shipments.show', $shipment) }}">{{ $shipment->tracking_number }}</a></span>
            </div>
            <div class="detail-item">
                <strong>Fee Name</strong>
                <span>{{ $fee->fee_name }}</span>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Description</strong>
                <span>{{ $fee->description ?? '—' }}</span>
            </div>
            <div class="detail-item">
                <strong>Amount</strong>
                <span>£{{ number_format($fee->amount, 2) }}</span>
            </div>
            <div class="detail-item">
                <strong>Status</strong>
                <span>
                    @if ($fee->status === 'paid')
                        <span class="badge badge-success">Paid</span>
                    @else
                        <span class="badge badge-warning">Unpaid</span>
                    @endif
                </span>
            </div>
            <div class="detail-item">
                <strong>Due Date</strong>
                <span>{{ $fee->due_date?->format('d M Y') ?? '—' }}</span>
            </div>
            <div class="detail-item">
                <strong>Created</strong>
                <span>{{ $fee->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="detail-item">
                <strong>Last Updated</strong>
                <span>{{ $fee->updated_at->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
