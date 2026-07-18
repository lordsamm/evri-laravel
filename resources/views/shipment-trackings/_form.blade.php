@php
    $trackingStatusOptions = \App\Models\ShipmentTracking::trackingStatusOptions();
@endphp

<input type="hidden" name="shipment_id" value="{{ $shipment->id }}">

<div class="form-group">
    <label for="location">Location</label>
    <input type="text" name="location" id="location" value="{{ old('location', $trackingEvent->location ?? '') }}" required>
    @error('location')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="country_id">Country ID</label>
    <input type="number" name="country_id" id="country_id" value="{{ old('country_id', $trackingEvent->country_id ?? '') }}" min="1">
    <div class="help-text">Optional for now. Country module not yet available.</div>
    @error('country_id')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="tracking_status">Tracking Status</label>
    <select name="tracking_status" id="tracking_status" required>
        @foreach ($trackingStatusOptions as $status)
            <option value="{{ $status }}" @selected(old('tracking_status', $trackingEvent->tracking_status ?? '') === $status)>
                {{ str_replace('_', ' ', ucfirst($status)) }}
            </option>
        @endforeach
    </select>
    @error('tracking_status')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="3">{{ old('description', $trackingEvent->description ?? '') }}</textarea>
    <div class="help-text">Optional. Additional details about this tracking event.</div>
    @error('description')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="event_datetime">Event Date & Time</label>
    <input type="datetime-local" name="event_datetime" id="event_datetime" value="{{ old('event_datetime', optional($trackingEvent->event_datetime)->format('Y-m-d\TH:i')) }}" required>
    @error('event_datetime')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>
