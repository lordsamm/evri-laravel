@php
    $currentStatusOptions = \App\Models\Shipment::currentStatusOptions();
    $paymentStatusOptions = \App\Models\Shipment::paymentStatusOptions();
    $countries = \App\Models\Country::active()->get();
    $shippingMethods = ['Standard', 'Express', 'Economy'];
@endphp

<h3>Sender Information</h3>

<div class="form-group">
    <label for="sender_name">Sender Name</label>
    <input type="text" name="sender_name" id="sender_name" value="{{ old('sender_name', $shipment->sender_name) }}" required>
    @error('sender_name')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="sender_phone">Sender Phone</label>
    <input type="text" name="sender_phone" id="sender_phone" value="{{ old('sender_phone', $shipment->sender_phone) }}">
    @error('sender_phone')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="sender_email">Sender Email</label>
    <input type="email" name="sender_email" id="sender_email" value="{{ old('sender_email', $shipment->sender_email) }}">
    @error('sender_email')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="sender_address">Sender Address</label>
    <textarea name="sender_address" id="sender_address" rows="3">{{ old('sender_address', $shipment->sender_address) }}</textarea>
    @error('sender_address')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<h3>Receiver Information</h3>

<div class="form-group">
    <label for="receiver_name">Receiver Name</label>
    <input type="text" name="receiver_name" id="receiver_name" value="{{ old('receiver_name', $shipment->receiver_name) }}" required>
    @error('receiver_name')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="receiver_phone">Receiver Phone</label>
    <input type="text" name="receiver_phone" id="receiver_phone" value="{{ old('receiver_phone', $shipment->receiver_phone) }}">
    @error('receiver_phone')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="receiver_email">Receiver Email</label>
    <input type="email" name="receiver_email" id="receiver_email" value="{{ old('receiver_email', $shipment->receiver_email) }}">
    @error('receiver_email')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="receiver_address">Receiver Address</label>
    <textarea name="receiver_address" id="receiver_address" rows="3">{{ old('receiver_address', $shipment->receiver_address) }}</textarea>
    @error('receiver_address')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<h3>Route Information</h3>

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

<h3>Parcel Information</h3>

<div class="form-group">
    <label for="parcel_description">Parcel Description</label>
    <textarea name="parcel_description" id="parcel_description" rows="3">{{ old('parcel_description', $shipment->parcel_description) }}</textarea>
    @error('parcel_description')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="parcel_weight">Parcel Weight (kg)</label>
    <input type="number" name="parcel_weight" id="parcel_weight" value="{{ old('parcel_weight', $shipment->parcel_weight) }}" step="0.01" min="0">
    @error('parcel_weight')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="parcel_quantity">Parcel Quantity</label>
    <input type="number" name="parcel_quantity" id="parcel_quantity" value="{{ old('parcel_quantity', $shipment->parcel_quantity ?? 1) }}" min="1">
    @error('parcel_quantity')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="declared_value">Declared Value (£)</label>
    <input type="number" name="declared_value" id="declared_value" value="{{ old('declared_value', $shipment->declared_value) }}" step="0.01" min="0">
    @error('declared_value')
        <div class="error-text">{{ $message }}</div>
    @enderror
</div>

<h3>Shipping Information</h3>

<div class="form-group">
    <label for="shipping_method">Shipping Method</label>
    <select name="shipping_method" id="shipping_method" required>
        @foreach ($shippingMethods as $method)
            <option value="{{ $method }}" @selected(old('shipping_method', $shipment->shipping_method ?? 'Standard') === $method)>
                {{ $method }}
            </option>
        @endforeach
    </select>
    @error('shipping_method')
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

<div class="form-group">
    <label for="internal_notes">Internal Notes (Admin Only)</label>
    <textarea name="internal_notes" id="internal_notes" rows="3">{{ old('internal_notes', $shipment->internal_notes) }}</textarea>
    @error('internal_notes')
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
