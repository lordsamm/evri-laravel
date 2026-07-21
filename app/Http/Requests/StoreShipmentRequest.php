<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sender_name' => ['required', 'string', 'max:255'],
            'sender_phone' => ['nullable', 'string', 'max:20'],
            'sender_email' => ['nullable', 'email', 'max:255'],
            'sender_address' => ['nullable', 'string'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'receiver_phone' => ['nullable', 'string', 'max:20'],
            'receiver_email' => ['nullable', 'email', 'max:255'],
            'receiver_address' => ['nullable', 'string'],
            'origin_country_id' => ['nullable', 'integer', 'min:1'],
            'destination_country_id' => ['nullable', 'integer', 'min:1'],
            'parcel_description' => ['nullable', 'string'],
            'parcel_weight' => ['nullable', 'numeric', 'min:0'],
            'parcel_quantity' => ['nullable', 'integer', 'min:1'],
            'declared_value' => ['nullable', 'numeric', 'min:0'],
            'shipping_method' => ['required', 'string', Rule::in(['Standard', 'Express', 'Economy'])],
            'internal_notes' => ['nullable', 'string'],
            'current_status' => ['required', 'string', Rule::in(Shipment::currentStatusOptions())],
            'payment_status' => ['required', 'string', Rule::in(Shipment::paymentStatusOptions())],
            'shipping_cost' => ['required', 'numeric', 'min:0'],
            'estimated_delivery' => ['nullable', 'date'],
        ];
    }
}
