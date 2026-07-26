<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipmentTracking extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_PICKED_UP = 'picked_up';

    public const STATUS_IN_TRANSIT = 'in_transit';

    public const STATUS_OUT_FOR_DELIVERY = 'out_for_delivery';

    public const STATUS_DELIVERED = 'delivered';

    public const STATUS_ATTEMPTED_DELIVERY = 'attempted_delivery';

    public const STATUS_EXCEPTION = 'exception';

    public const STATUS_CANCELLED = 'cancelled';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'shipment_id',
        'location',
        'country_id',
        'tracking_status',
        'description',
        'event_datetime',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_datetime' => 'datetime',
        ];
    }

    /**
     * @return list<string>
     */
    public static function trackingStatusOptions(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_PICKED_UP,
            self::STATUS_IN_TRANSIT,
            self::STATUS_OUT_FOR_DELIVERY,
            self::STATUS_DELIVERED,
            self::STATUS_ATTEMPTED_DELIVERY,
            self::STATUS_EXCEPTION,
            self::STATUS_CANCELLED,
        ];
    }

    /**
     * Get the shipment that owns the tracking event.
     */
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    /**
     * Scope a query to order by event datetime ascending.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeChronological($query)
    {
        return $query->orderBy('event_datetime', 'asc');
    }
}
