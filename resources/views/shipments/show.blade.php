@extends('layouts.admin')

@section('title', 'Shipment '.$shipment->tracking_number)

@section('content')
    <div class="page-header">
        <h2>Shipment Details</h2>
        <div>
            <a href="{{ route('admin.shipments.edit', $shipment) }}" class="btn btn-secondary">Edit</a>
            <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs mb-4" id="shipmentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tracking-tab" data-bs-toggle="tab" data-bs-target="#tracking" type="button" role="tab">Tracking</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="fees-tab" data-bs-toggle="tab" data-bs-target="#fees" type="button" role="tab">Fees</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">Documents</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="shipmentTabsContent">
        <!-- Details Tab -->
        <div class="tab-pane fade show active" id="details" role="tabpanel">
            <div class="card p-4">
        <h3>Sender Information</h3>
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Tracking Number</strong>
                {{ $shipment->tracking_number }}
            </div>
            <div class="detail-item">
                <strong>Sender Name</strong>
                {{ $shipment->sender_name }}
            </div>
            <div class="detail-item">
                <strong>Sender Phone</strong>
                {{ $shipment->sender_phone ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Sender Email</strong>
                {{ $shipment->sender_email ?? '—' }}
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Sender Address</strong>
                {{ $shipment->sender_address ?? '—' }}
            </div>
        </div>

        <h3>Receiver Information</h3>
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Receiver Name</strong>
                {{ $shipment->receiver_name }}
            </div>
            <div class="detail-item">
                <strong>Receiver Phone</strong>
                {{ $shipment->receiver_phone ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Receiver Email</strong>
                {{ $shipment->receiver_email ?? '—' }}
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Receiver Address</strong>
                {{ $shipment->receiver_address ?? '—' }}
            </div>
        </div>

        <h3>Route Information</h3>
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Origin Country</strong>
                {{ $shipment->originCountry?->name ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Destination Country</strong>
                {{ $shipment->destinationCountry?->name ?? '—' }}
            </div>
        </div>

        <h3>Parcel Information</h3>
        <div class="detail-grid">
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Parcel Description</strong>
                {{ $shipment->parcel_description ?? '—' }}
            </div>
            <div class="detail-item">
                <strong>Parcel Weight</strong>
                {{ $shipment->parcel_weight ? number_format($shipment->parcel_weight, 2) . ' kg' : '—' }}
            </div>
            <div class="detail-item">
                <strong>Parcel Quantity</strong>
                {{ $shipment->parcel_quantity ?? 1 }}
            </div>
            <div class="detail-item">
                <strong>Declared Value</strong>
                {{ $shipment->declared_value ? '£' . number_format($shipment->declared_value, 2) : '—' }}
            </div>
        </div>

        <h3>Shipping Information</h3>
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Shipping Method</strong>
                {{ $shipment->shipping_method }}
            </div>
            <div class="detail-item">
                <strong>Current Status</strong>
                {{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}
            </div>
            <div class="detail-item">
                <strong>Payment Status</strong>
                {{ ucfirst($shipment->payment_status) }}
            </div>
            <div class="detail-item">
                <strong>Shipping Cost</strong>
                £{{ number_format($shipment->shipping_cost, 2) }}
            </div>
            <div class="detail-item">
                <strong>Estimated Delivery</strong>
                {{ $shipment->estimated_delivery?->format('d M Y') ?? '—' }}
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <strong>Internal Notes</strong>
                {{ $shipment->internal_notes ?? '—' }}
            </div>
        </div>

        <h3>Timestamps</h3>
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Created</strong>
                {{ $shipment->created_at->format('d M Y H:i') }}
            </div>
            <div class="detail-item">
                <strong>Last Updated</strong>
                {{ $shipment->updated_at->format('d M Y H:i') }}
            </div>
        </div>
            </div>
        </div>

        <!-- Tracking Tab -->
        <div class="tab-pane fade" id="tracking" role="tabpanel">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Tracking Timeline</h3>
                    <a href="{{ route('admin.shipments.trackings.index', $shipment) }}" class="btn btn-primary">Manage Tracking</a>
                </div>
                <p class="text-muted">View and manage tracking events for this shipment.</p>
            </div>
        </div>

        <!-- Fees Tab -->
        <div class="tab-pane fade" id="fees" role="tabpanel">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Shipment Fees</h3>
                    <a href="{{ route('admin.shipments.fees.index', $shipment) }}" class="btn btn-primary">Manage Fees</a>
                </div>
                <p class="text-muted">View and manage fees for this shipment.</p>
            </div>
        </div>

        <!-- Documents Tab -->
        <div class="tab-pane fade" id="documents" role="tabpanel">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Documents</h3>
                    <a href="{{ route('admin.shipments.documents.index', $shipment) }}" class="btn btn-primary">
                        <i class="bi bi-upload me-2"></i>Upload Document
                    </a>
                </div>
                <p class="text-muted">Upload, preview, download, and manage shipment documents.</p>
            </div>
        </div>
    </div>
@endsection
