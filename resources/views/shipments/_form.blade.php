@php
    $currentStatusOptions = \App\Models\Shipment::currentStatusOptions();
    $paymentStatusOptions = \App\Models\Shipment::paymentStatusOptions();
    $countries = \App\Models\Country::active()->get();
@endphp

<div class="form-group">
    <label for="sender_name">Sender Name</label>
    <input type="text" name="sender_name" id="sender_name" value="{{ old('sender_name', $shipment->sender_name) }}" required>
    @error('sender_name')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="receiver_name">Receiver Name</label>
    <input type="text" name="receiver_name" id="receiver_name" value="{{ old('receiver_name', $shipment->receiver_name) }}" required>
    @error('receiver_name')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="origin_country_id">Origin Country</label>
    <select name="origin_country_id" id="origin_country_id">
        <option value="">Select a country</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(old('origin_country_id', $shipment->origin_country_id) == $country->id)>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    @error('origin_country_id')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="destination_country_id">Destination Country</label>
    <select name="destination_country_id" id="destination_country_id">
        <option value="">Select a country</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(old('destination_country_id', $shipment->destination_country_id) == $country->id)>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    @error('destination_country_id')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="current_status">Current Status</label>
    <select name="current_status" id="current_status" required>
        @foreach ($currentStatusOptions as $status)
            <option value="{{ $status }}" @selected(old('current_status', $shipment->current_status) === $status)>
                {{ str_replace('_', ' ', ucfirst($status)) }}
            </option>
        @endforeach
    </select>
    @error('current_status')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="payment_status">Payment Status</label>
    <select name="payment_status" id="payment_status" required>
        @foreach ($paymentStatusOptions as $status)
            <option value="{{ $status }}" @selected(old('payment_status', $shipment->payment_status) === $status)>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
    @error('payment_status')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="shipping_cost">Shipping Cost (£)</label>
    <input type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $shipment->shipping_cost) }}" step="0.01" min="0" required>
    @error('shipping_cost')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="estimated_delivery">Estimated Delivery</label>
    <input type="date" name="estimated_delivery" id="estimated_delivery" value="{{ old('estimated_delivery', optional($shipment->estimated_delivery)->format('Y-m-d')) }}">
    @error('estimated_delivery')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

@if ($shipment->exists)
    <div class="form-group">
        <label>Tracking Number</label>
        <input type="text" value="{{ $shipment->tracking_number }}" readonly>
        <div class="help-text">Tracking numbers are generated automatically and cannot be edited.</div>
    </div>
@else
    <div class="form-group">
        <label>Tracking Number</label>
        <input type="text" value="Generated automatically on save" readonly>
        <div class="help-text">A unique tracking number starting with EV will be assigned when the shipment is created.</div>
    </div>
@endif
