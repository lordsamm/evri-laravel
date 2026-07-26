<form method="POST" action="{{ isset($fee) ? route('admin.shipments.fees.update', [$shipment, $fee]) : route('admin.shipments.fees.store', $shipment) }}">
    @csrf
    @if(isset($fee))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="fee_name">Fee Name</label>
        <input type="text" id="fee_name" name="fee_name" value="{{ old('fee_name', isset($fee) ? $fee->fee_name : '') }}" required>
        @error('fee_name')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="3">{{ old('description', isset($fee) ? $fee->description : '') }}</textarea>
        @error('description')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">Amount (£)</label>
        <input type="number" id="amount" name="amount" value="{{ old('amount', isset($fee) ? $fee->amount : '') }}" step="0.01" min="0" required>
        @error('amount')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="unpaid" @selected(old('status', isset($fee) ? $fee->status : 'unpaid') === 'unpaid')">Unpaid</option>
            <option value="paid" @selected(old('status', isset($fee) ? $fee->status : 'unpaid') === 'paid')">Paid</option>
        </select>
        @error('status')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="due_date">Due Date</label>
        <input type="date" id="due_date" name="due_date" value="{{ old('due_date', isset($fee) && $fee->due_date ? $fee->due_date->format('Y-m-d') : '') }}">
        @error('due_date')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($fee) ? 'Update' : 'Create' }} Fee</button>
</form>
