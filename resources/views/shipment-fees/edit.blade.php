@extends('layouts.admin')

@section('title', 'Edit Fee - '.$fee->fee_name)

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Edit Fee - {{ $fee->fee_name }}</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.shipments.fees.index', $shipment) }}" class="btn btn-secondary">Back to Fees</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @include('shipment-fees._form')
        </div>
    </div>
</div>
@endsection
