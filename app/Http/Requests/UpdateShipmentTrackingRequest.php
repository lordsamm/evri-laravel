<?php

namespace App\Http\Requests;

use App\Models\ShipmentTracking;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShipmentTrackingRequest extends FormRequest
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
            'shipment_id' => ['required', 'integer', 'exists:shipments,id'],
            'location' => ['required', 'string', 'max:255'],
            'country_id' => ['nullable', 'integer', 'min:1'],
            'tracking_status' => ['required', 'string', Rule::in(ShipmentTracking::trackingStatusOptions())],
            'description' => ['nullable', 'string', 'max:1000'],
            'event_datetime' => ['required', 'date'],
        ];
    }
}
