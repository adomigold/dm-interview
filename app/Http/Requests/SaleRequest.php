<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'customer_id' => 'required|exists:customers,id',
            'payment_method' => 'required|in:cash,credit_card,debit_card',
            'payment_status' => 'required|in:paid,not_paid',
            'delivery_status' => 'required|in:delivered,not_delivered',
            'delivery_address' => 'required_if:delivery_status,delivered',
        ];

        // If the request is a POST request, then we need to validate the products array
        if ($this->isMethod('POST')) {
            $rules['products'] = 'required';
        } else {
            // If the request is a PUT request, jus validate quantity only
            $rules['quantity'] = 'nullable|integer|min:1';
        }

        return $rules;
    }
}
