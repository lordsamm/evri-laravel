@extends('layouts.admin')

@section('title', 'Payment Proofs')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Payment Proofs</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tracking Number</th>
                        <th>Fee</th>
                        <th>Amount</th>
                        <th>Payer</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proofs as $proof)
                        <tr>
                            <td>
                                <a href="{{ route('admin.shipments.show', $proof->shipmentFee->shipment) }}">
                                    {{ $proof->shipmentFee->shipment->tracking_number }}
                                </a>
                            </td>
                            <td>{{ $proof->shipmentFee->fee_name }}</td>
                            <td>£{{ number_format($proof->shipmentFee->amount, 2) }}</td>
                            <td>{{ $proof->payer_name }}</td>
                            <td>
                                @if ($proof->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($proof->status === 'verified')
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $proof->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.payment-proofs.show', $proof) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $proofs->links() }}
        </div>
    </div>
</div>
@endsection
