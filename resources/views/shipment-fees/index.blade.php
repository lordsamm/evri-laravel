@extends('layouts.admin')

@section('title', 'Fees for Shipment '.$shipment->tracking_number)

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Fees for Shipment {{ $shipment->tracking_number }}</h2>
        <div>
            <a href="{{ route('admin.shipments.fees.create', $shipment) }}" class="btn btn-primary">Add Fee</a>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-secondary">Back to Shipment</a>
        </div>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Fee Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fees as $fee)
                        <tr>
                            <td>{{ $fee->fee_name }}</td>
                            <td>{{ $fee->description ?? '—' }}</td>
                            <td>£{{ number_format($fee->amount, 2) }}</td>
                            <td>
                                @if ($fee->status === 'paid')
                                    <span class="badge badge-success">Paid</span>
                                @else
                                    <span class="badge badge-warning">Unpaid</span>
                                @endif
                            </td>
                            <td>{{ $fee->due_date?->format('d M Y') ?? '—' }}</td>
                            <td>
                                <a href="{{ route('admin.shipments.fees.show', [$shipment, $fee]) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('admin.shipments.fees.edit', [$shipment, $fee]) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form method="POST" action="{{ route('admin.shipments.fees.destroy', [$shipment, $fee]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this fee?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $fees->links() }}
        </div>
    </div>
</div>
@endsection
