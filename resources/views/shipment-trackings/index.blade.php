@extends('layouts.admin')

@section('title', 'Tracking Timeline - '.$shipment->tracking_number)

@section('content')
    <div class="page-header">
        <h2>Tracking Timeline</h2>
        <div>
            <a href="{{ route('admin.shipments.trackings.create', $shipment) }}" class="btn btn-primary">Add Tracking Event</a>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-secondary">Back to Shipment</a>
        </div>
    </div>

    <div class="card">
        <div class="shipment-info">
            <strong>Shipment:</strong> {{ $shipment->tracking_number }}
            <span style="margin: 0 1rem;">|</span>
            <strong>From:</strong> {{ $shipment->sender_name }}
            <span style="margin: 0 1rem;">|</span>
            <strong>To:</strong> {{ $shipment->receiver_name }}
        </div>

        @if ($trackingEvents->isEmpty())
            <p style="margin-top: 1rem;">No tracking events yet. <a href="{{ route('admin.shipments.trackings.create', $shipment) }}">Add the first tracking event</a>.</p>
        @else
            <div class="timeline" style="margin-top: 1rem;">
                @foreach ($trackingEvents as $index => $event)
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="timeline-status">{{ str_replace('_', ' ', ucfirst($event->tracking_status)) }}</span>
                                <span class="timeline-date">{{ $event->event_datetime->format('d M Y H:i') }}</span>
                            </div>
                            <div class="timeline-location">{{ $event->location }}</div>
                            @if ($event->description)
                                <div class="timeline-description">{{ $event->description }}</div>
                            @endif
                            <div class="timeline-actions">
                                <a href="{{ route('admin.shipments.trackings.edit', [$shipment, $event]) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form method="POST" action="{{ route('admin.shipments.trackings.destroy', [$shipment, $event]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tracking event?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
