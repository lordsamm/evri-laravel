@extends('layouts.admin')

@section('title', 'Tracking Event Details - '.$shipment->tracking_number)

@section('content')
    <div class="page-header">
        <h2>Tracking Event Details</h2>
        <div>
            <a href="{{ route('admin.shipments.trackings.edit', [$shipment, $trackingEvent]) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin.shipments.trackings.index', $shipment) }}" class="btn btn-secondary">Back to Timeline</a>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-secondary">Back to Shipment</a>
        </div>
    </div>

    <div class="card">
        <div class="shipment-info" style="margin-bottom: 1rem;">
            <strong>Shipment:</strong> {{ $shipment->tracking_number }}
            <span style="margin: 0 1rem;">|</span>
            <strong>From:</strong> {{ $shipment->sender_name }}
            <span style="margin: 0 1rem;">|</span>
            <strong>To:</strong> {{ $shipment->receiver_name }}
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <strong>Tracking Status</strong>
                {{ str_replace('_', ' ', ucfirst($trackingEvent->tracking_status)) }}
            </div>
            <div class="detail-item">
                <strong>Location</strong>
                {{ $trackingEvent->location }}
            </div>
            <div class="detail-item">
                <strong>Country ID</strong>
                {{ $trackingEvent->country_id ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Event Date & Time</strong>
                {{ $trackingEvent->event_datetime->format('d M Y H:i') }}
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Description</strong>
                {{ $trackingEvent->description ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Created</strong>
                {{ $trackingEvent->created_at->format('d M Y H:i') }}
            </div>
            <div class="detail-item">
                <strong>Last Updated</strong>
                {{ $trackingEvent->updated_at->format('d M Y H:i') }}
            </div>
        </div>
    </div>
@endsection
