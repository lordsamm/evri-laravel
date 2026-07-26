@extends('layouts.admin')

@section('title', 'Add Fee to Shipment '.$shipment->tracking_number)

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Add Fee to Shipment {{ $shipment->tracking_number }}</h2>
        <a href="{{ route('admin.shipments.fees.index', $shipment) }}" class="btn btn-secondary">Back to Fees</a>
    </div>

    <div class="card p-4">
        @include('shipment-fees._form')
    </div>
</div>
@endsection
