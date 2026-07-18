<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShipmentRequest extends FormRequest
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
            'receiver_name' => ['required', 'string', 'max:255'],
            'origin_country_id' => ['nullable', 'integer', 'min:1'],
            'destination_country_id' => ['nullable', 'integer', 'min:1'],
            'current_status' => ['required', 'string', Rule::in(Shipment::currentStatusOptions())],
            'payment_status' => ['required', 'string', Rule::in(Shipment::paymentStatusOptions())],
            'shipping_cost' => ['required', 'numeric', 'min:0'],
            'estimated_delivery' => ['nullable', 'date'],
        ];
    }
}
