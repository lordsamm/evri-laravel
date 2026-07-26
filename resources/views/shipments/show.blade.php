@extends('layouts.admin')

@section('title', 'Shipment '.$shipment->tracking_number)

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Shipment Command Center</h2>
        <div>
            <a href="{{ route('admin.shipments.edit', $shipment) }}" class="btn btn-primary">Edit Shipment</a>
            <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">Back to Shipments</a>
        </div>
    </div>

    <!-- SECTION 1: Shipment Overview -->
    <div class="card p-4 mb-4" style="background: linear-gradient(135deg, var(--evri-purple-primary) 0%, var(--evri-purple-dark) 100%);">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-box-seam fs-1 me-3" style="color: var(--evri-purple-light);"></i>
                    <div>
                        <h3 class="mb-1" style="color: white;">{{ $shipment->tracking_number }}</h3>
                        <p style="color: var(--evri-purple-light); margin: 0;">Created {{ $shipment->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">Status:</span>
                        @if($shipment->current_status === 'delivered')
                            <span class="badge badge-success ms-2" style="font-size: 1rem;">{{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}</span>
                        @elseif($shipment->current_status === 'pending')
                            <span class="badge badge-warning ms-2" style="font-size: 1rem;">{{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}</span>
                        @else
                            <span class="badge badge-purple ms-2" style="font-size: 1rem;">{{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">Payment:</span>
                        <span class="badge badge-purple ms-2" style="font-size: 1rem;">{{ ucfirst($shipment->payment_status) }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">From:</span>
                        <span style="color: white; margin-left: 0.5rem;">{{ $shipment->originCountry?->name ?? '—' }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">To:</span>
                        <span style="color: white; margin-left: 0.5rem;">{{ $shipment->destinationCountry?->name ?? '—' }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">Sender:</span>
                        <span style="color: white; margin-left: 0.5rem;">{{ $shipment->sender_name }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">Receiver:</span>
                        <span style="color: white; margin-left: 0.5rem;">{{ $shipment->receiver_name }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">Type:</span>
                        <span style="color: white; margin-left: 0.5rem;">{{ $shipment->shipping_method }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">Est. Delivery:</span>
                        <span style="color: white; margin-left: 0.5rem;">{{ $shipment->estimated_delivery?->format('d M Y') ?? '—' }}</span>
                    </div>
                    @if($shipment->parcel_weight)
                    <div class="col-md-6 mb-2">
                        <span style="color: rgba(255,255,255,0.7);">Weight:</span>
                        <span style="color: white; margin-left: 0.5rem;">{{ number_format($shipment->parcel_weight, 2) }} kg</span>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div style="background: rgba(255,255,255,0.1); border-radius: var(--radius-lg); padding: 1.5rem;">
                    <p style="color: rgba(255,255,255,0.7); margin: 0; font-size: 0.875rem;">Total Cost</p>
                    <h2 style="color: white; margin: 0.5rem 0;">£{{ number_format($shipment->shipping_cost, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8">
            <!-- SECTION 2: Shipment Progress -->
            <div class="card p-4 mb-4">
                <h3 class="mb-4">Shipment Progress</h3>
                <div class="progress-steps">
                    @php
                        $stages = [
                            'pending' => ['label' => 'Created', 'icon' => 'bi-box-seam'],
                            'picked_up' => ['label' => 'Picked Up', 'icon' => 'bi-truck'],
                            'processing' => ['label' => 'Processing', 'icon' => 'bi-gear'],
                            'in_transit' => ['label' => 'In Transit', 'icon' => 'bi-airplane'],
                            'customs' => ['label' => 'Customs', 'icon' => 'bi-passport'],
                            'out_for_delivery' => ['label' => 'Out For Delivery', 'icon' => 'bi-truck'],
                            'delivered' => ['label' => 'Delivered', 'icon' => 'bi-check-circle'],
                        ];
                        $stageOrder = ['pending', 'picked_up', 'processing', 'in_transit', 'customs', 'out_for_delivery', 'delivered'];
                        $currentStage = $shipment->current_status;
                        $currentIndex = array_search($currentStage, $stageOrder);
                    @endphp
                    <div class="d-flex justify-content-between align-items-center">
                        @foreach($stageOrder as $index => $stage)
                            @php
                                $stageInfo = $stages[$stage] ?? ['label' => ucfirst($stage), 'icon' => 'bi-circle'];
                                $isCompleted = $index < $currentIndex;
                                $isCurrent = $index === $currentIndex;
                                $isFuture = $index > $currentIndex;
                            @endphp
                            <div class="progress-step {{ $isCompleted ? 'completed' : '' }} {{ $isCurrent ? 'current' : '' }} {{ $isFuture ? 'future' : '' }}" style="flex: 1;">
                                <div class="step-icon">
                                    <i class="bi {{ $stageInfo['icon'] }}"></i>
                                </div>
                                <div class="step-label">{{ $stageInfo['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Activity Timeline -->
            <div class="card p-4 mb-4">
                <h3 class="mb-4">Activity Timeline</h3>
                <div class="activity-timeline">
                    @php
                        $activities = collect();
                        
                        // Shipment Created
                        $activities->push([
                            'type' => 'shipment_created',
                            'title' => 'Shipment Created',
                            'description' => 'Tracking number: ' . $shipment->tracking_number,
                            'icon' => 'bi-box-seam',
                            'icon_color' => 'var(--evri-purple-primary)',
                            'timestamp' => $shipment->created_at,
                        ]);

                        // Tracking Events
                        foreach($shipment->trackingEvents as $event) {
                            $activities->push([
                                'type' => 'tracking_update',
                                'title' => 'Tracking Update: ' . str_replace('_', ' ', ucfirst($event->tracking_status)),
                                'description' => $event->location . ($event->description ? ' - ' . $event->description : ''),
                                'icon' => 'bi-geo-alt',
                                'icon_color' => 'var(--evri-purple-primary)',
                                'timestamp' => $event->event_datetime,
                            ]);
                        }

                        // Fees
                        foreach($shipment->fees as $fee) {
                            $activities->push([
                                'type' => 'fee_created',
                                'title' => 'Fee Added: ' . $fee->fee_name,
                                'description' => '£' . number_format($fee->amount, 2) . ' - ' . ucfirst($fee->status),
                                'icon' => 'bi-currency-pound',
                                'icon_color' => 'var(--evri-purple-primary)',
                                'timestamp' => $fee->created_at,
                            ]);
                        }

                        // Documents
                        foreach($shipment->documents as $doc) {
                            $activities->push([
                                'type' => 'document_uploaded',
                                'title' => 'Document Uploaded: ' . $doc->document_name,
                                'description' => $doc->document_type_label,
                                'icon' => 'bi-file-earmark',
                                'icon_color' => 'var(--evri-purple-primary)',
                                'timestamp' => $doc->created_at,
                            ]);
                        }

                        // Sort by timestamp descending
                        $activities = $activities->sortByDesc('timestamp')->values();
                    @endphp

                    @if($activities->isEmpty())
                        <p class="text-muted">No activity recorded yet.</p>
                    @else
                        @foreach($activities as $activity)
                            <div class="timeline-item">
                                <div class="timeline-icon" style="background: {{ $activity['icon_color'] }};">
                                    <i class="bi {{ $activity['icon'] }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <span class="timeline-title">{{ $activity['title'] }}</span>
                                        <span class="timeline-time">{{ $activity['timestamp']->format('d M Y H:i') }}</span>
                                    </div>
                                    <div class="timeline-description">{{ $activity['description'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- SECTION 4: Shipment Fees Summary -->
            <div class="card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Shipment Fees</h3>
                    <a href="{{ route('admin.shipments.fees.index', $shipment) }}" class="btn btn-primary btn-sm">Manage Fees</a>
                </div>
                
                @if($shipment->fees->isEmpty())
                    <p class="text-muted">No fees recorded for this shipment.</p>
                @else
                    <div class="row">
                        @foreach($shipment->fees as $fee)
                        <div class="col-md-6 mb-3">
                            <div class="fee-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1">{{ $fee->fee_name }}</h5>
                                        <p class="text-muted mb-2">{{ $fee->description ?? '—' }}</p>
                                    </div>
                                    <span class="badge {{ $fee->status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($fee->status) }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fee-amount">£{{ number_format($fee->amount, 2) }}</span>
                                    <span class="text-muted">{{ $fee->due_date?->format('d M Y') ?? 'No due date' }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="fees-summary mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="summary-item">
                                    <span class="summary-label">Total Fees</span>
                                    <span class="summary-value">£{{ number_format($shipment->fees->sum('amount'), 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="summary-item">
                                    <span class="summary-label">Paid</span>
                                    <span class="summary-value text-success">£{{ number_format($shipment->fees->where('status', 'paid')->sum('amount'), 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="summary-item">
                                    <span class="summary-label">Outstanding</span>
                                    <span class="summary-value text-warning">£{{ number_format($shipment->fees->where('status', 'unpaid')->sum('amount'), 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- SECTION 5: Documents -->
            <div class="card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Documents</h3>
                    <a href="{{ route('admin.shipments.documents.index', $shipment) }}" class="btn btn-primary btn-sm">Manage Documents</a>
                </div>
                
                @if($shipment->documents->isEmpty())
                    <p class="text-muted">No documents uploaded for this shipment.</p>
                @else
                    <div class="row">
                        @foreach($shipment->documents as $doc)
                        <div class="col-md-6 mb-3">
                            <div class="document-card">
                                <div class="d-flex align-items-start">
                                    <div class="document-icon">
                                        @if($doc->isPdf())
                                            <i class="bi bi-file-earmark-pdf" style="color: var(--danger);"></i>
                                        @elseif($doc->isImage())
                                            <i class="bi bi-file-earmark-image" style="color: var(--evri-purple-primary);"></i>
                                        @else
                                            <i class="bi bi-file-earmark" style="color: var(--gray-500);"></i>
                                        @endif
                                    </div>
                                    <div class="document-info flex-grow-1">
                                        <h5 class="mb-1">{{ $doc->document_name }}</h5>
                                        <p class="text-muted mb-1">{{ $doc->document_type_label }}</p>
                                        <p class="text-muted mb-2" style="font-size: 0.875rem;">{{ $doc->created_at?->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="document-actions">
                                    <a href="{{ route('admin.shipments.documents.preview', [$shipment, $doc]) }}" class="btn btn-sm btn-primary">Preview</a>
                                    <a href="{{ route('admin.shipments.documents.download', [$shipment, $doc]) }}" class="btn btn-sm btn-success">Download</a>
                                    <a href="{{ route('admin.shipments.documents.edit', [$shipment, $doc]) }}" class="btn btn-sm btn-secondary">Replace</a>
                                    <form method="POST" action="{{ route('admin.shipments.documents.destroy', [$shipment, $doc]) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this document?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <!-- SECTION 6: Quick Actions -->
            <div class="card p-4 mb-4">
                <h3 class="mb-4">Quick Actions</h3>
                <div class="quick-actions">
                    <a href="{{ route('admin.shipments.trackings.create', $shipment) }}" class="quick-action-btn">
                        <i class="bi bi-geo-alt"></i>
                        <span>Add Tracking</span>
                    </a>
                    <a href="{{ route('admin.shipments.fees.create', $shipment) }}" class="quick-action-btn">
                        <i class="bi bi-currency-pound"></i>
                        <span>Add Fee</span>
                    </a>
                    <a href="{{ route('admin.shipments.documents.create', $shipment) }}" class="quick-action-btn">
                        <i class="bi bi-upload"></i>
                        <span>Upload Document</span>
                    </a>
                    <a href="{{ route('admin.shipments.edit', $shipment) }}" class="quick-action-btn">
                        <i class="bi bi-pencil"></i>
                        <span>Edit Shipment</span>
                    </a>
                    <a href="{{ route('admin.shipments.index') }}" class="quick-action-btn">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back to Shipments</span>
                    </a>
                </div>
            </div>

            <!-- SECTION 7: Recent Tracking -->
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Recent Tracking</h3>
                    <a href="{{ route('admin.shipments.trackings.index', $shipment) }}" class="btn btn-sm btn-secondary">View All</a>
                </div>
                
                @if($shipment->trackingEvents->isEmpty())
                    <p class="text-muted">No tracking events recorded.</p>
                @else
                    <div class="recent-tracking">
                        @foreach($shipment->trackingEvents->take(5) as $event)
                        <div class="tracking-item">
                            <div class="tracking-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="tracking-details">
                                <div class="tracking-status">{{ str_replace('_', ' ', ucfirst($event->tracking_status)) }}</div>
                                <div class="tracking-location">{{ $event->location }}</div>
                                <div class="tracking-time">{{ $event->event_datetime->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Progress Steps */
.progress-steps {
    padding: 1rem 0;
}

.progress-step {
    text-align: center;
    position: relative;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    font-size: 1.25rem;
    color: var(--gray-500);
    transition: all 0.3s ease;
}

.progress-step.completed .step-icon {
    background: var(--evri-purple-primary);
    color: white;
}

.progress-step.current .step-icon {
    background: var(--evri-purple-light);
    color: white;
    box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.2);
}

.progress-step.future .step-icon {
    background: var(--gray-100);
    color: var(--gray-400);
}

.step-label {
    font-size: 0.75rem;
    color: var(--gray-500);
    font-weight: 500;
}

.progress-step.completed .step-label,
.progress-step.current .step-label {
    color: var(--evri-purple-primary);
    font-weight: 600;
}

/* Activity Timeline */
.activity-timeline {
    position: relative;
}

.timeline-item {
    display: flex;
    gap: 1rem;
    padding-bottom: 1.5rem;
    position: relative;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 20px;
    top: 45px;
    bottom: 0;
    width: 2px;
    background: var(--gray-200);
}

.timeline-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.timeline-content {
    flex-grow: 1;
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.25rem;
}

.timeline-title {
    font-weight: 600;
    color: var(--gray-800);
}

.timeline-time {
    font-size: 0.875rem;
    color: var(--gray-500);
}

.timeline-description {
    color: var(--gray-600);
    font-size: 0.875rem;
}

/* Fee Cards */
.fee-card {
    background: var(--evri-purple-bg);
    border-radius: var(--radius-lg);
    padding: 1rem;
    border: 1px solid var(--evri-purple-light);
}

.fee-amount {
    font-weight: 600;
    font-size: 1.125rem;
    color: var(--evri-purple-primary);
}

.fees-summary {
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    padding: 1rem;
}

.summary-item {
    text-align: center;
    padding: 0.5rem;
}

.summary-label {
    display: block;
    font-size: 0.875rem;
    color: var(--gray-500);
    margin-bottom: 0.25rem;
}

.summary-value {
    display: block;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-800);
}

/* Document Cards */
.document-card {
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    padding: 1rem;
    border: 1px solid var(--gray-200);
}

.document-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-md);
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-right: 1rem;
}

.document-info h5 {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.document-actions {
    margin-top: 1rem;
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* Quick Actions */
.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    background: var(--evri-purple-bg);
    border: 1px solid var(--evri-purple-light);
    border-radius: var(--radius-lg);
    color: var(--evri-purple-primary);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.quick-action-btn:hover {
    background: var(--evri-purple-primary);
    color: white;
    border-color: var(--evri-purple-primary);
}

.quick-action-btn i {
    font-size: 1.25rem;
}

/* Recent Tracking */
.recent-tracking {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.tracking-item {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.tracking-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--evri-purple-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--evri-purple-primary);
    flex-shrink: 0;
}

.tracking-details {
    flex-grow: 1;
}

.tracking-status {
    font-weight: 600;
    color: var(--gray-800);
    font-size: 0.875rem;
}

.tracking-location {
    color: var(--gray-600);
    font-size: 0.875rem;
}

.tracking-time {
    color: var(--gray-500);
    font-size: 0.75rem;
}

/* Responsive */
@media (max-width: 768px) {
    .progress-steps {
        flex-direction: column;
    }
    
    .progress-step {
        margin-bottom: 1rem;
    }
    
    .step-icon {
        margin: 0 auto 0.5rem;
    }
    
    .document-actions {
        flex-direction: column;
    }
    
    .document-actions .btn {
        width: 100%;
    }
}
</style>
@endsection
