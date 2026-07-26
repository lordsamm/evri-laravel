@extends('layouts.admin')

@section('title', 'Country - '.$country->name)

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Country Details</h2>
        <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">Back to Countries</a>
        <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-primary">Edit</a>
    </div>

    <div class="card p-4">
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Name</strong>
                <span>{{ $country->name }}</span>
            </div>
            <div class="detail-item">
                <strong>ISO2</strong>
                <span>{{ $country->iso2 }}</span>
            </div>
            <div class="detail-item">
                <strong>ISO3</strong>
                <span>{{ $country->iso3 }}</span>
            </div>
            <div class="detail-item">
                <strong>Phone Code</strong>
                <span>{{ $country->phone_code ?? '—' }}</span>
            </div>
            <div class="detail-item">
                <strong>Status</strong>
                <span>
                    @if ($country->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-purple">Inactive</span>
                    @endif
                </span>
            </div>
            <div class="detail-item">
                <strong>Created At</strong>
                <span>{{ $country->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="detail-item">
                <strong>Updated At</strong>
                <span>{{ $country->updated_at->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
