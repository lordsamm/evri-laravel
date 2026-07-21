@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Countries</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">Add Country</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ISO2</th>
                        <th>ISO3</th>
                        <th>Phone Code</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->iso2 }}</td>
                            <td>{{ $country->iso3 }}</td>
                            <td>{{ $country->phone_code ?? '—' }}</td>
                            <td>
                                @if ($country->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.countries.show', $country) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $countries->links() }}
        </div>
    </div>
</div>
@endsection
