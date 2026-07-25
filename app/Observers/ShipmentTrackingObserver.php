<?php

namespace App\Observers;

use App\Models\Shipment;
use App\Models\ShipmentTracking;

class ShipmentTrackingObserver
{
    /**
     * Handle the ShipmentTracking "created" event.
     */
    public function created(ShipmentTracking $shipmentTracking): void
    {
        $shipmentTracking->shipment->update([
            'current_status' => $shipmentTracking->tracking_status
        ]);
    }

    /**
     * Handle the ShipmentTracking "updated" event.
     */
    public function updated(ShipmentTracking $shipmentTracking): void
    {
        // Only update shipment status if this is the latest tracking event
        $latestEvent = $shipmentTracking->shipment->trackingEvents()->latest('event_datetime')->first();
        
        if ($latestEvent && $latestEvent->id === $shipmentTracking->id) {
            $shipmentTracking->shipment->update([
                'current_status' => $shipmentTracking->tracking_status
            ]);
        }
    }

    /**
     * Handle the ShipmentTracking "deleted" event.
     */
    public function deleted(ShipmentTracking $shipmentTracking): void
    {
        $shipment = $shipmentTracking->shipment;
        
        // Find the newest remaining tracking event
        $latestEvent = $shipment->trackingEvents()->latest('event_datetime')->first();
        
        if ($latestEvent) {
            $shipment->update([
                'current_status' => $latestEvent->tracking_status
            ]);
        } else {
            // No tracking events remain, reset to default
            $shipment->update([
                'current_status' => Shipment::STATUS_PENDING
            ]);
        }
    }

    /**
     * Handle the ShipmentTracking "restored" event.
     */
    public function restored(ShipmentTracking $shipmentTracking): void
    {
        $shipmentTracking->shipment->update([
            'current_status' => $shipmentTracking->tracking_status
        ]);
    }

    /**
     * Handle the ShipmentTracking "force deleted" event.
     */
    public function forceDeleted(ShipmentTracking $shipmentTracking): void
    {
        $this->deleted($shipmentTracking);
    }
}
