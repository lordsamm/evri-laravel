<form method="POST" action="{{ isset($country) ? route('admin.countries.update', $country) : route('admin.countries.store') }}">
    @csrf
    @if(isset($country))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $country->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="iso2" class="form-label">ISO2 Code</label>
        <input type="text" class="form-control @error('iso2') is-invalid @enderror" id="iso2" name="iso2" value="{{ old('iso2', $country->iso2 ?? '') }}" maxlength="2" required>
        @error('iso2')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="iso3" class="form-label">ISO3 Code</label>
        <input type="text" class="form-control @error('iso3') is-invalid @enderror" id="iso3" name="iso3" value="{{ old('iso3', $country->iso3 ?? '') }}" maxlength="3" required>
        @error('iso3')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone_code" class="form-label">Phone Code</label>
        <input type="text" class="form-control @error('phone_code') is-invalid @enderror" id="phone_code" name="phone_code" value="{{ old('phone_code', $country->phone_code ?? '') }}" maxlength="10">
        @error('phone_code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" {{ old('is_active', $country->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Active</label>
        @error('is_active')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($country) ? 'Update' : 'Create' }} Country</button>
</form>
