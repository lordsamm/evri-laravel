@extends('layouts.admin')

@section('title', 'All Shipments')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>All Shipments</h2>
        <a href="{{ route('admin.shipments.create') }}" class="btn btn-primary">Create Shipment</a>
    </div>

    <div class="card p-4">
        @if ($shipments->isEmpty())
            <div class="text-center py-5">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📦</div>
                <p class="mb-0 text-muted">No shipments yet.</p>
                <a href="{{ route('admin.shipments.create') }}" class="btn btn-primary mt-3">Create the first shipment</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tracking Number</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Cost</th>
                            <th>Est. Delivery</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipments as $shipment)
                            <tr>
                                <td><a href="{{ route('admin.shipments.show', $shipment) }}">{{ $shipment->tracking_number }}</a></td>
                                <td>{{ $shipment->sender_name }}</td>
                                <td>{{ $shipment->receiver_name }}</td>
                                <td>
                                    @if($shipment->current_status === 'delivered')
                                        <span class="badge badge-success">{{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}</span>
                                    @elseif($shipment->current_status === 'pending')
                                        <span class="badge badge-warning">{{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}</span>
                                    @else
                                        <span class="badge badge-purple">{{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($shipment->payment_status) }}</td>
                                <td>£{{ number_format($shipment->shipping_cost, 2) }}</td>
                                <td>{{ $shipment->estimated_delivery?->format('d M Y') ?? '—' }}</td>
                                <td><a href="{{ route('admin.shipments.edit', $shipment) }}" class="btn btn-sm btn-secondary">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1rem;">
                {{ $shipments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
