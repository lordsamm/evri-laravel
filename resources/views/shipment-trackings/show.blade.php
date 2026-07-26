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

    <div class="card p-4">
        <div style="padding: 1rem; background: var(--evri-purple-bg); border-radius: var(--radius-lg); margin-bottom: var(--spacing-lg);">
            <strong>Shipment:</strong> {{ $shipment->tracking_number }}
            <span style="margin: 0 1rem;">|</span>
            <strong>From:</strong> {{ $shipment->sender_name }}
            <span style="margin: 0 1rem;">|</span>
            <strong>To:</strong> {{ $shipment->receiver_name }}
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <strong>Tracking Status</strong>
                <span>{{ str_replace('_', ' ', ucfirst($trackingEvent->tracking_status)) }}</span>
            </div>
            <div class="detail-item">
                <strong>Location</strong>
                <span>{{ $trackingEvent->location }}</span>
            </div>
            <div class="detail-item">
                <strong>Country ID</strong>
                <span>{{ $trackingEvent->country_id ?? '—' }}</span>
            </div>
            <div class="detail-item">
                <strong>Event Date & Time</strong>
                <span>{{ $trackingEvent->event_datetime->format('d M Y H:i') }}</span>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Description</strong>
                <span>{{ $trackingEvent->description ?? '—' }}</span>
            </div>
            <div class="detail-item">
                <strong>Created</strong>
                <span>{{ $trackingEvent->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="detail-item">
                <strong>Last Updated</strong>
                <span>{{ $trackingEvent->updated_at->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>
@endsection
