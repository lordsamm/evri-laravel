@if(isset($shipment))
<div class="tracking-results-section" style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
    <div style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; margin-bottom: 1rem; color: #1a1a1a; border-bottom: 2px solid #f0f0f0; padding-bottom: 0.5rem;">Shipment Details</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Tracking Number</label>
                <span style="font-family: monospace; font-size: 1.1rem; font-weight: 600; color: #0066cc;">{{ $shipment->tracking_number }}</span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Sender</label>
                <span style="color: #1a1a1a; font-size: 1rem;">{{ $shipment->sender_name }}</span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Receiver</label>
                <span style="color: #1a1a1a; font-size: 1rem;">{{ $shipment->receiver_name }}</span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Current Status</label>
                <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.875rem; font-weight: 600; text-transform: capitalize; background: {{ $shipment->current_status == 'delivered' ? '#d4edda' : ($shipment->current_status == 'in_transit' ? '#cce5ff' : '#fff3cd') }}; color: {{ $shipment->current_status == 'delivered' ? '#155724' : ($shipment->current_status == 'in_transit' ? '#004085' : '#856404') }};">{{ str_replace('_', ' ', ucfirst($shipment->current_status)) }}</span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Payment Status</label>
                <span style="color: #1a1a1a; font-size: 1rem;">{{ ucfirst($shipment->payment_status) }}</span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Origin Country ID</label>
                <span style="color: #1a1a1a; font-size: 1rem;">{{ $shipment->origin_country_id ?? '—' }}</span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Destination Country ID</label>
                <span style="color: #1a1a1a; font-size: 1rem;">{{ $shipment->destination_country_id ?? '—' }}</span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label style="font-weight: 600; color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Estimated Delivery</label>
                <span style="color: #1a1a1a; font-size: 1rem;">{{ $shipment->estimated_delivery?->format('d M Y') ?? '—' }}</span>
            </div>
        </div>
    </div>

    <div style="background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; margin-bottom: 1rem; color: #1a1a1a; border-bottom: 2px solid #f0f0f0; padding-bottom: 0.5rem;">Tracking Timeline</h2>
        @if ($trackingEvents && $trackingEvents->isEmpty())
            <p style="color: #666; font-style: italic; text-align: center; padding: 1rem;">No tracking events recorded yet.</p>
        @elseif ($trackingEvents)
            <div style="position: relative; padding-left: 2rem;">
                <div style="content: ''; position: absolute; left: 0.5rem; top: 0; bottom: 0; width: 2px; background: #e0e0e0;"></div>
                @foreach ($trackingEvents as $event)
                    <div style="position: relative; margin-bottom: 1.5rem;">
                        <div style="position: absolute; left: -2rem; top: 0; width: 12px; height: 12px; border-radius: 50%; background: #0066cc; border: 2px solid white; box-shadow: 0 0 0 2px #0066cc;"></div>
                        <div style="background: #f9f9f9; padding: 1rem; border-radius: 6px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <span style="font-weight: 600; color: #0066cc;">{{ str_replace('_', ' ', ucfirst($event->tracking_status)) }}</span>
                                <span style="color: #666; font-size: 0.875rem;">{{ $event->event_datetime->format('d M Y H:i') }}</span>
                            </div>
                            <div style="font-weight: 500; color: #1a1a1a; margin-bottom: 0.25rem;">{{ $event->location }}</div>
                            @if ($event->description)
                                <div style="color: #666; font-size: 0.875rem;">{{ $event->description }}</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #666; font-style: italic; text-align: center; padding: 1rem;">No tracking events recorded yet.</p>
        @endif
    </div>

    <div style="text-align: center;">
        <a href="{{ url('/track-a-parcel') }}" style="display: inline-block; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none; font-weight: 500; cursor: pointer; background: #6c757d; color: white; border: none;">Track Another Parcel</a>
    </div>
</div>
@endif
