<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipmentDocument extends Model
{
    // Document Types
    public const TYPE_INVOICE = 'invoice';
    public const TYPE_SHIPPING_LABEL = 'shipping_label';
    public const TYPE_BILL_OF_LADING = 'bill_of_lading';
    public const TYPE_PACKING_LIST = 'packing_list';
    public const TYPE_CUSTOMS_DECLARATION = 'customs_declaration';
    public const TYPE_INSURANCE_CERTIFICATE = 'insurance_certificate';
    public const TYPE_DELIVERY_RECEIPT = 'delivery_receipt';
    public const TYPE_RECEIVER_SIGNATURE = 'receiver_signature';
    public const TYPE_OTHER = 'other';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'shipment_id',
        'document_name',
        'document_type',
        'file_path',
        'file_size',
        'mime_type',
        'uploaded_by',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    /**
     * Get all document type options.
     */
    public static function documentTypeOptions(): array
    {
        return [
            self::TYPE_INVOICE => 'Invoice',
            self::TYPE_SHIPPING_LABEL => 'Shipping Label',
            self::TYPE_BILL_OF_LADING => 'Bill of Lading',
            self::TYPE_PACKING_LIST => 'Packing List',
            self::TYPE_CUSTOMS_DECLARATION => 'Customs Declaration',
            self::TYPE_INSURANCE_CERTIFICATE => 'Insurance Certificate',
            self::TYPE_DELIVERY_RECEIPT => 'Delivery Receipt',
            self::TYPE_RECEIVER_SIGNATURE => 'Receiver Signature',
            self::TYPE_OTHER => 'Other',
        ];
    }

    /**
     * Get the shipment that owns the document.
     */
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    /**
     * Get the user who uploaded the document.
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the document type label.
     */
    public function getDocumentTypeLabelAttribute(): string
    {
        return self::documentTypeOptions()[$this->document_type] ?? ucfirst($this->document_type);
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if document is an image.
     */
    public function isImage(): bool
    {
        return in_array($this->mime_type, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']);
    }

    /**
     * Check if document is a PDF.
     */
    public function isPdf(): bool
    {
        return $this->mime_type === 'application/pdf';
    }
}
