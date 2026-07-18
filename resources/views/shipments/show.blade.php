@extends('layouts.admin')

@section('title', 'Shipment '.$shipment->tracking_number)

@section('content')
    <div class="page-header">
        <h2>Shipment Details</h2>
        <div>
            <a href="{{ route('admin.shipments.trackings.index', $shipment) }}" class="btn btn-primary">View Tracking Timeline</a>
            <a href="{{ route('admin.shipments.edit', $shipment) }}" class="btn btn-secondary">Edit</a>
            <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>

    <div class="card">
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Tracking Number</strong>
                {{ $shipment->tracking_number }}
            </div>
            <div class="detail-item">
                <strong>Sender Name</strong>
                {{ $shipment->sender_name }}
            </div>
            <div class="detail-item">
                <strong>Receiver Name</strong>
                {{ $shipment->receiver_name }}
            </div>
            <div class="detail-item">
                <strong>Origin Country ID</strong>
                {{ $shipment->origin_country_id ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Destination Country ID</strong>
                {{ $shipment->destination_country_id ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Current Status</strong>
                {{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}
            </div>
            <div class="detail-item">
                <strong>Payment Status</strong>
                {{ ucfirst($shipment->payment_status) }}
            </div>
            <div class="detail-item">
                <strong>Shipping Cost</strong>
                £{{ number_format($shipment->shipping_cost, 2) }}
            </div>
            <div class="detail-item">
                <strong>Estimated Delivery</strong>
                {{ $shipment->estimated_delivery?->format('d M Y') ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Created</strong>
                {{ $shipment->created_at->format('d M Y H:i') }}
            </div>
            <div class="detail-item">
                <strong>Last Updated</strong>
                {{ $shipment->updated_at->format('d M Y H:i') }}
            </div>
        </div>
    </div>
@endsection
