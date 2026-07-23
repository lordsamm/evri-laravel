<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentProof extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_VERIFIED = 'verified';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'shipment_fee_id',
        'payer_name',
        'payment_reference',
        'receipt_path',
        'note',
        'status',
    ];

    public function shipmentFee(): BelongsTo
    {
        return $this->belongsTo(ShipmentFee::class);
    }
}
