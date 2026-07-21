@extends('layouts.admin')

@section('title', 'Fee - '.$fee->fee_name)

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Fee Details</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.shipments.fees.edit', [$shipment, $fee]) }}" class="btn btn-warning">Edit</a>
            <form method="POST" action="{{ route('admin.shipments.fees.destroy', [$shipment, $fee]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this fee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('admin.shipments.fees.index', $shipment) }}" class="btn btn-secondary">Back to Fees</a>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-secondary">Back to Shipment</a>
        </div>
    </div>

    <div class="card">
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Shipment</strong>
                <a href="{{ route('admin.shipments.show', $shipment) }}">{{ $shipment->tracking_number }}</a>
            </div>
            <div class="detail-item">
                <strong>Fee Name</strong>
                {{ $fee->fee_name }}
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Description</strong>
                {{ $fee->description ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Amount</strong>
                £{{ number_format($fee->amount, 2) }}
            </div>
            <div class="detail-item">
                <strong>Status</strong>
                @if ($fee->status === 'paid')
                    <span class="badge bg-success">Paid</span>
                @else
                    <span class="badge bg-warning">Unpaid</span>
                @endif
            </div>
            <div class="detail-item">
                <strong>Due Date</strong>
                {{ $fee->due_date?->format('d M Y') ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Created</strong>
                {{ $fee->created_at->format('d M Y H:i') }}
            </div>
            <div class="detail-item">
                <strong>Last Updated</strong>
                {{ $fee->updated_at->format('d M Y H:i') }}
            </div>
        </div>
    </div>
</div>
@endsection
