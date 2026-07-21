@extends('layouts.admin')

@section('title', 'Add Fee to Shipment '.$shipment->tracking_number)

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Add Fee to Shipment {{ $shipment->tracking_number }}</h1>
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
