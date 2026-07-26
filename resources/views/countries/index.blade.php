@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Countries</h2>
        <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">Add Country</a>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover">
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
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-purple">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.countries.show', $country) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-sm btn-secondary">Edit</a>
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
