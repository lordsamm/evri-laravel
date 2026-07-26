@extends('layouts.admin')

@section('title', 'Edit Fee - '.$fee->fee_name)

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Edit Fee - {{ $fee->fee_name }}</h2>
        <a href="{{ route('admin.shipments.fees.index', $shipment) }}" class="btn btn-secondary">Back to Fees</a>
    </div>

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.shipments.fees.update', [$shipment, $fee]) }}">
            @csrf
            @method('PUT')

            @include('shipment-fees._form')

            <button type="submit" class="btn btn-primary">Update Fee</button>
        </form>
    </div>
</div>
@endsection
