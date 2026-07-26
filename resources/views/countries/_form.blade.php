<form method="POST" action="{{ isset($country) ? route('admin.countries.update', $country) : route('admin.countries.store') }}">
    @csrf
    @if(isset($country))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $country->name ?? '') }}" required>
        @error('name')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="iso2">ISO2 Code</label>
        <input type="text" id="iso2" name="iso2" value="{{ old('iso2', $country->iso2 ?? '') }}" maxlength="2" required>
        @error('iso2')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="iso3">ISO3 Code</label>
        <input type="text" id="iso3" name="iso3" value="{{ old('iso3', $country->iso3 ?? '') }}" maxlength="3" required>
        @error('iso3')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone_code">Phone Code</label>
        <input type="text" id="phone_code" name="phone_code" value="{{ old('phone_code', $country->phone_code ?? '') }}" maxlength="10">
        @error('phone_code')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label style="display: flex; align-items: center; gap: 0.5rem;">
            <input type="checkbox" id="is_active" name="is_active" {{ old('is_active', $country->is_active ?? true) ? 'checked' : '' }} style="width: auto; max-width: none;">
            Active
        </label>
        @error('is_active')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($country) ? 'Update' : 'Create' }} Country</button>
</form>
