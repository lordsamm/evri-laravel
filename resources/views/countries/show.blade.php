@extends('layouts.admin')

@section('title', 'Country - '.$country->name)

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Country Details</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">Back to Countries</a>
            <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <label>Name</label>
                    <span>{{ $country->name }}</span>
                </div>
                <div class="detail-item">
                    <label>ISO2</label>
                    <span>{{ $country->iso2 }}</span>
                </div>
                <div class="detail-item">
                    <label>ISO3</label>
                    <span>{{ $country->iso3 }}</span>
                </div>
                <div class="detail-item">
                    <label>Phone Code</label>
                    <span>{{ $country->phone_code ?? '—' }}</span>
                </div>
                <div class="detail-item">
                    <label>Status</label>
                    <span>
                        @if ($country->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </span>
                </div>
                <div class="detail-item">
                    <label>Created At</label>
                    <span>{{ $country->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="detail-item">
                    <label>Updated At</label>
                    <span>{{ $country->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
