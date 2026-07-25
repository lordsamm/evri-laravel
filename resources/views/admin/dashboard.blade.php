@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1>Dashboard</h1>

    <h2>📦 Shipment Statistics</h2>
    <ul>
        <li>Total Shipments: {{ $totalShipments }}</li>
        <li>Pending Shipments: {{ $pendingShipments }}</li>
        <li>In Transit: {{ $inTransitShipments }}</li>
        <li>Delivered: {{ $deliveredShipments }}</li>
        <li>Returned: {{ $returnedShipments }}</li>
        <li>Held: {{ $heldShipments }}</li>
        <li>Cancelled: {{ $cancelledShipments }}</li>
    </ul>

    <h2>💳 Payment Statistics</h2>
    <ul>
        <li>Total Fees: {{ $totalFees }}</li>
        <li>Paid Fees: {{ $paidFees }}</li>
        <li>Unpaid Fees: {{ $unpaidFees }}</li>
        <li>Pending Payment Proofs: {{ $pendingPaymentProofs }}</li>
        <li>Verified Payment Proofs: {{ $verifiedPaymentProofs }}</li>
        <li>Rejected Payment Proofs: {{ $rejectedPaymentProofs }}</li>
    </ul>

    <h2>🌍 Country Statistics</h2>
    <ul>
        <li>Total Countries: {{ $totalCountries }}</li>
        <li>Active Countries: {{ $activeCountries }}</li>
    </ul>

    <h2>📈 Revenue Statistics</h2>
    <ul>
        <li>Total Fees Value: £{{ number_format($totalFeesValue, 2) }}</li>
        <li>Paid Revenue: £{{ number_format($paidRevenue, 2) }}</li>
        <li>Outstanding Revenue: £{{ number_format($outstandingRevenue, 2) }}</li>
    </ul>

    <h2>📋 Recent Activity</h2>
    
    <h3>Latest 5 Shipments</h3>
    <ul>
        @foreach($recentShipments as $shipment)
            <li>{{ $shipment->tracking_number }} - {{ $shipment->current_status }}</li>
        @endforeach
    </ul>

    <h3>Latest 5 Tracking Updates</h3>
    <ul>
        @foreach($recentTrackingUpdates as $tracking)
            <li>{{ $tracking->shipment->tracking_number }} - {{ $tracking->status }}</li>
        @endforeach
    </ul>

    <h3>Latest 5 Payment Proofs</h3>
    <ul>
        @foreach($recentPaymentProofs as $proof)
            <li>{{ $proof->payer_name }} - {{ $proof->status }}</li>
        @endforeach
    </ul>

    <h2>⚡ Quick Actions Data</h2>
    <ul>
        <li>Create Shipment: {{ route('admin.shipments.create') }}</li>
        <li>Add Country: {{ route('admin.countries.create') }}</li>
        <li>View Pending Payments: {{ route('admin.payment-proofs.index') }}</li>
        <li>View All Shipments: {{ route('admin.shipments.index') }}</li>
    </ul>

    <h2>🔗 Navigation Data</h2>
    <ul>
        <li>Pending Payments ({{ $pendingPaymentsCount }})</li>
        <li>Shipments ({{ $totalShipments }})</li>
        <li>Countries ({{ $totalCountries }})</li>
    </ul>
</div>
@endsection
