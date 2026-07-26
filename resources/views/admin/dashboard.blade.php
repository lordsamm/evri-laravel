@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Dashboard</h2>
    </div>

    <!-- SECTION 1: Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Shipments -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.shipments.index') }}" class="stat-card">
                <div class="card h-100 p-4">
                    <div class="stat-icon" style="color: var(--evri-purple-primary);">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stat-number">{{ $totalShipments }}</div>
                    <div class="stat-title">Total Shipments</div>
                </div>
            </a>
        </div>

        <!-- Active Shipments -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.shipments.index') }}" class="stat-card">
                <div class="card h-100 p-4">
                    <div class="stat-icon" style="color: var(--warning);">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div class="stat-number">{{ $pendingShipments + $inTransitShipments + $heldShipments }}</div>
                    <div class="stat-title">Active Shipments</div>
                </div>
            </a>
        </div>

        <!-- Delivered Shipments -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.shipments.index') }}" class="stat-card">
                <div class="card h-100 p-4">
                    <div class="stat-icon" style="color: var(--success);">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $deliveredShipments }}</div>
                    <div class="stat-title">Delivered Shipments</div>
                </div>
            </a>
        </div>

        <!-- Countries -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.countries.index') }}" class="stat-card">
                <div class="card h-100 p-4">
                    <div class="stat-icon" style="color: var(--info);">
                        <i class="bi bi-globe"></i>
                    </div>
                    <div class="stat-number">{{ $totalCountries }}</div>
                    <div class="stat-title">Countries</div>
                </div>
            </a>
        </div>

        <!-- Pending Payment Proofs -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.payment-proofs.index') }}" class="stat-card">
                <div class="card h-100 p-4">
                    <div class="stat-icon" style="color: var(--danger);">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="stat-number">{{ $pendingPaymentProofs }}</div>
                    <div class="stat-title">Pending Payment Proofs</div>
                </div>
            </a>
        </div>

        <!-- Outstanding Revenue -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="#" class="stat-card">
                <div class="card h-100 p-4">
                    <div class="stat-icon" style="color: var(--success);">
                        <i class="bi bi-currency-pound"></i>
                    </div>
                    <div class="stat-number">£{{ number_format($outstandingRevenue, 2) }}</div>
                    <div class="stat-title">Outstanding Revenue</div>
                </div>
            </a>
        </div>
    </div>

    <!-- SECTION 2: Charts -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card p-4">
                <h5 class="mb-4">Shipment Status Distribution</h5>
                <canvas id="shipmentStatusChart"></canvas>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card p-4">
                <h5 class="mb-4">Monthly Shipment Activity</h5>
                <canvas id="monthlyActivityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- SECTION 3: Recent Shipments -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <h5 class="mb-4">Recent Shipments</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Sender</th>
                                <th>Receiver</th>
                                <th>Current Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentShipments as $shipment)
                            <tr>
                                <td>{{ $shipment->tracking_number }}</td>
                                <td>{{ $shipment->sender_name }}</td>
                                <td>{{ $shipment->receiver_name }}</td>
                                <td>
                                    @if($shipment->current_status === 'delivered')
                                        <span class="badge badge-success">{{ ucfirst($shipment->current_status) }}</span>
                                    @elseif($shipment->current_status === 'pending')
                                        <span class="badge badge-warning">{{ ucfirst($shipment->current_status) }}</span>
                                    @else
                                        <span class="badge badge-purple">{{ ucfirst($shipment->current_status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $shipment->created_at ? $shipment->created_at->format('M d, Y') : '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 4: Recent Tracking Updates -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <h5 class="mb-4">Recent Tracking Updates</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTrackingUpdates as $tracking)
                            <tr>
                                <td>{{ $tracking->shipment->tracking_number }}</td>
                                <td>{{ $tracking->location }}</td>
                                <td>
                                    <span class="badge badge-info">{{ ucfirst($tracking->tracking_status) }}</span>
                                </td>
                                <td>{{ $tracking->event_datetime ? $tracking->event_datetime->format('M d, Y H:i') : '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 5: Recent Payment Proofs -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <h5 class="mb-4">Recent Payment Proofs</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Fee Name</th>
                                <th>Payer</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPaymentProofs as $proof)
                            <tr>
                                <td>{{ $proof->shipmentFee->shipment->tracking_number ?? '—' }}</td>
                                <td>{{ $proof->shipmentFee->fee_name ?? '—' }}</td>
                                <td>{{ $proof->payer_name }}</td>
                                <td>
                                    @if($proof->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($proof->status === 'verified')
                                        <span class="badge badge-success">Verified</span>
                                    @elseif($proof->status === 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.payment-proofs.show', $proof) }}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 6: Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <h5 class="mb-4">Quick Actions</h5>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('admin.shipments.create') }}" class="btn btn-lg btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Create Shipment
                    </a>
                    <a href="{{ route('admin.countries.index') }}" class="btn btn-lg btn-secondary">
                        <i class="bi bi-globe me-2"></i>Manage Countries
                    </a>
                    <a href="{{ route('admin.payment-proofs.index') }}" class="btn btn-lg btn-secondary">
                        <i class="bi bi-credit-card me-2"></i>Review Payment Proofs
                    </a>
                    <a href="#" class="btn btn-lg btn-secondary">
                        <i class="bi bi-cash-stack me-2"></i>Manage Shipment Fees
                    </a>
                    <a href="#" class="btn btn-lg btn-secondary">
                        <i class="bi bi-geo-alt me-2"></i>Manage Tracking
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 7: Dashboard Footer -->
    <div class="dashboard-footer">
        <p class="mb-0">Last Updated: {{ now()->format('F j, Y, g:i A') }}</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Shipment Status Distribution Pie Chart
    const shipmentStatusCtx = document.getElementById('shipmentStatusChart').getContext('2d');
    new Chart(shipmentStatusCtx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'In Transit', 'Delivered', 'Held', 'Returned', 'Cancelled'],
            datasets: [{
                data: [{{ $pendingShipments }}, {{ $inTransitShipments }}, {{ $deliveredShipments }}, {{ $heldShipments }}, {{ $returnedShipments }}, {{ $cancelledShipments }}],
                backgroundColor: [
                    '#ffc107',
                    '#0d6efd',
                    '#198754',
                    '#fd7e14',
                    '#6c757d',
                    '#dc3545'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Monthly Shipment Activity Bar Chart (Placeholder)
    const monthlyActivityCtx = document.getElementById('monthlyActivityChart').getContext('2d');
    new Chart(monthlyActivityCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Shipments',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: '#6b21a8'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
