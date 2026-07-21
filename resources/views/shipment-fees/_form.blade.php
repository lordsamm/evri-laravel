<form method="POST" action="{{ isset($fee) ? route('admin.shipments.fees.update', [$shipment, $fee]) : route('admin.shipments.fees.store', $shipment) }}">
    @csrf
    @if(isset($fee))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="fee_name" class="form-label">Fee Name</label>
        <input type="text" class="form-control @error('fee_name') is-invalid @enderror" id="fee_name" name="fee_name" value="{{ old('fee_name', isset($fee) ? $fee->fee_name : '') }}" required>
        @error('fee_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', isset($fee) ? $fee->description : '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label">Amount (£)</label>
        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', isset($fee) ? $fee->amount : '') }}" step="0.01" min="0" required>
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
            <option value="unpaid" @selected(old('status', isset($fee) ? $fee->status : 'unpaid') === 'unpaid')">Unpaid</option>
            <option value="paid" @selected(old('status', isset($fee) ? $fee->status : 'unpaid') === 'paid')">Paid</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', isset($fee) && $fee->due_date ? $fee->due_date->format('Y-m-d') : '') }}">
        @error('due_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($fee) ? 'Update' : 'Create' }} Fee</button>
</form>
