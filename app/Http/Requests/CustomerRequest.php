<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'customer_code' => 'required|string|max:20|unique:customers,customer_code',

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:customers,email',

            'phone' => 'required|string|max:20',

            'company_name' => 'nullable|string|max:255',

            'gst_number' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'city' => 'nullable|string|max:100',

            'state' => 'nullable|string|max:100',

            'country' => 'nullable|string|max:100',

            'pincode' => 'nullable|string|max:10',

            'status' => 'required|in:Active,Inactive',

            'notes' => 'nullable|string',
        ];
    }
}
