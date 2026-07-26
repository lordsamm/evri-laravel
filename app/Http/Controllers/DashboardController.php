<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PaymentProof;
use App\Models\Shipment;
use App\Models\ShipmentFee;
use App\Models\ShipmentTracking;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Shipment Statistics
        $totalShipments = Shipment::count();
        $pendingShipments = Shipment::where('current_status', Shipment::STATUS_PENDING)->count();
        $inTransitShipments = Shipment::where('current_status', Shipment::STATUS_IN_TRANSIT)->count();
        $deliveredShipments = Shipment::where('current_status', Shipment::STATUS_DELIVERED)->count();
        $cancelledShipments = Shipment::where('current_status', Shipment::STATUS_CANCELLED)->count();
        $heldShipments = Shipment::where('current_status', 'held')->count();
        $returnedShipments = Shipment::where('current_status', 'returned')->count();

        // Payment Statistics
        $totalFees = ShipmentFee::count();
        $paidFees = ShipmentFee::where('status', ShipmentFee::STATUS_PAID)->count();
        $unpaidFees = ShipmentFee::where('status', ShipmentFee::STATUS_UNPAID)->count();
        $pendingPaymentProofs = PaymentProof::where('status', PaymentProof::STATUS_PENDING)->count();
        $verifiedPaymentProofs = PaymentProof::where('status', PaymentProof::STATUS_VERIFIED)->count();
        $rejectedPaymentProofs = PaymentProof::where('status', PaymentProof::STATUS_REJECTED)->count();

        // Country Statistics
        $totalCountries = Country::count();
        $activeCountries = Country::where('is_active', true)->count();

        // Revenue Statistics
        $totalFeesValue = ShipmentFee::sum('amount');
        $paidRevenue = ShipmentFee::where('status', ShipmentFee::STATUS_PAID)->sum('amount');
        $outstandingRevenue = ShipmentFee::where('status', ShipmentFee::STATUS_UNPAID)->sum('amount');

        // Recent Activity
        $recentShipments = Shipment::with(['originCountry', 'destinationCountry'])
            ->latest()
            ->limit(5)
            ->get();
        
        $recentTrackingUpdates = ShipmentTracking::with('shipment')
            ->latest()
            ->limit(5)
            ->get();
        
        $recentPaymentProofs = PaymentProof::with('shipmentFee.shipment')
            ->latest()
            ->limit(5)
            ->get();

        // Quick Actions Data
        $pendingPaymentsCount = $pendingPaymentProofs;

        return view('admin.dashboard', compact(
            // Shipment Statistics
            'totalShipments',
            'pendingShipments',
            'inTransitShipments',
            'deliveredShipments',
            'cancelledShipments',
            'heldShipments',
            'returnedShipments',
            // Payment Statistics
            'totalFees',
            'paidFees',
            'unpaidFees',
            'pendingPaymentProofs',
            'verifiedPaymentProofs',
            'rejectedPaymentProofs',
            // Country Statistics
            'totalCountries',
            'activeCountries',
            // Revenue Statistics
            'totalFeesValue',
            'paidRevenue',
            'outstandingRevenue',
            // Recent Activity
            'recentShipments',
            'recentTrackingUpdates',
            'recentPaymentProofs',
            // Quick Actions
            'pendingPaymentsCount',
        ));
    }
}
