@extends('layouts.admin')

@section('title', 'Payment Proofs')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Payment Proofs</h2>
    </div>

    <div class="card p-4">
        @if ($proofs->isEmpty())
            <div class="text-center py-5">
                <p class="mb-0 text-muted">No payment proofs submitted yet.</p>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover">
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
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($proof->status === 'verified')
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $proof->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.payment-proofs.show', $proof) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $proofs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
