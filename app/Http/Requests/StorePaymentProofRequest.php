<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentProofRequest extends FormRequest
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
            'payer_name' => ['required', 'string', 'max:255'],
            'payment_reference' => ['nullable', 'string', 'max:255'],
            'receipt' => ['required', 'file', 'image', 'max:5120'],
            'note' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
