<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_IN_TRANSIT = 'in_transit';

    public const STATUS_OUT_FOR_DELIVERY = 'out_for_delivery';

    public const STATUS_DELIVERED = 'delivered';

    public const STATUS_CANCELLED = 'cancelled';

    public const PAYMENT_UNPAID = 'unpaid';

    public const PAYMENT_PAID = 'paid';

    public const PAYMENT_REFUNDED = 'refunded';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'sender_name',
        'sender_phone',
        'sender_email',
        'sender_address',
        'receiver_name',
        'receiver_phone',
        'receiver_email',
        'receiver_address',
        'origin_country_id',
        'destination_country_id',
        'parcel_description',
        'parcel_weight',
        'parcel_quantity',
        'declared_value',
        'shipping_method',
        'internal_notes',
        'current_status',
        'payment_status',
        'shipping_cost',
        'estimated_delivery',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'shipping_cost' => 'decimal:2',
            'parcel_weight' => 'decimal:2',
            'declared_value' => 'decimal:2',
            'estimated_delivery' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Shipment $shipment): void {
            if (empty($shipment->tracking_number)) {
                $shipment->tracking_number = static::generateUniqueTrackingNumber();
            }
        });
    }

    /**
     * @return list<string>
     */
    public static function currentStatusOptions(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_IN_TRANSIT,
            self::STATUS_OUT_FOR_DELIVERY,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED,
        ];
    }

    /**
     * @return list<string>
     */
    public static function paymentStatusOptions(): array
    {
        return [
            self::PAYMENT_UNPAID,
            self::PAYMENT_PAID,
            self::PAYMENT_REFUNDED,
        ];
    }

    public static function generateUniqueTrackingNumber(): string
    {
        do {
            $number = 'EV'.str_pad((string) random_int(0, 99999999999999), 14, '0', STR_PAD_LEFT);
        } while (static::where('tracking_number', $number)->exists());

        return $number;
    }

    /**
     * Get all tracking events for the shipment.
     */
    public function trackingEvents(): HasMany
    {
        return $this->hasMany(ShipmentTracking::class)->chronological();
    }

    /**
     * Get the origin country for the shipment.
     */
    public function originCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'origin_country_id');
    }

    /**
     * Get the destination country for the shipment.
     */
    public function destinationCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'destination_country_id');
    }

    /**
     * Get all fees for the shipment.
     */
    public function fees(): HasMany
    {
        return $this->hasMany(ShipmentFee::class);
    }

    /**
     * Get all documents for the shipment.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(ShipmentDocument::class);
    }
}
