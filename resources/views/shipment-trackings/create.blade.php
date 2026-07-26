@extends('layouts.admin')

@section('title', 'Add Tracking Event - '.$shipment->tracking_number)

@section('content')
    <div class="page-header">
        <h2>Add Tracking Event</h2>
        <div>
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

        <form method="POST" action="{{ route('admin.shipments.trackings.store', $shipment) }}">
            @csrf

            @include('shipment-trackings._form')

            <button type="submit" class="btn btn-primary">Add Tracking Event</button>
        </form>
    </div>
@endsection
