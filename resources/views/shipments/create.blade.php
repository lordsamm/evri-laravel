@extends('layouts.admin')

@section('title', 'Create Shipment')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Create Shipment</h2>
        <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">Back to list</a>
    </div>

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.shipments.store') }}">
            @csrf

            @include('shipments._form')

            <button type="submit" class="btn btn-primary">Create Shipment</button>
        </form>
    </div>
</div>
@endsection
