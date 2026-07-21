@extends('layouts.admin')

@section('title', 'Fees for Shipment '.$shipment->tracking_number)

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Fees for Shipment {{ $shipment->tracking_number }}</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.shipments.fees.create', $shipment) }}" class="btn btn-primary">Add Fee</a>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-secondary">Back to Shipment</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
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
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning">Unpaid</span>
                                @endif
                            </td>
                            <td>{{ $fee->due_date?->format('d M Y') ?? '—' }}</td>
                            <td>
                                <a href="{{ route('admin.shipments.fees.show', [$shipment, $fee]) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.shipments.fees.edit', [$shipment, $fee]) }}" class="btn btn-sm btn-warning">Edit</a>
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
