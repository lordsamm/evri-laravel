@extends('layouts.admin')

@section('title', 'Edit Shipment')

@section('content')
    <div class="page-header">
        <h2>Edit Shipment</h2>
        <div>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-secondary">View</a>
            <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.shipments.update', $shipment) }}">
            @csrf
            @method('PUT')

            @include('shipments._form')

            <button type="submit" class="btn btn-primary">Update Shipment</button>
        </form>
    </div>
@endsection
