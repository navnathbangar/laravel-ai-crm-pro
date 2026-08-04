<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateCustomerRequest extends FormRequest
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

            'customer_code' => [
                'required',
                'max:20',
                Rule::unique('customers')
                    ->ignore($this->customer),
            ],

            'name' => 'required|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('customers')
                    ->ignore($this->customer),
            ],

            'phone' => 'required|max:20',

            'company_name' => 'nullable|max:255',

            'gst_number' => 'nullable|max:20',

            'address' => 'nullable',

            'city' => 'nullable|max:100',

            'state' => 'nullable|max:100',

            'country' => 'nullable|max:100',

            'pincode' => 'nullable|max:10',

            'status' => 'required|in:Active,Inactive',

            'notes' => 'nullable',

        ];
    }
}
