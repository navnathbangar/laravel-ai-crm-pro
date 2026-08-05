<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $companyId = $this->route('company')->id;

        return [

            'company_code' => 'required|string|max:50|unique:companies,company_code,' . $companyId,

            'company_name' => 'required|string|max:255',

            'contact_person' => 'nullable|string|max:255',

            'email' => 'required|email|max:255|unique:companies,email,' . $companyId,

            'phone' => 'required|string|max:20',

            'website' => 'nullable|url|max:255',

            'gst_number' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'city' => 'nullable|string|max:100',

            'state' => 'nullable|string|max:100',

            'country' => 'nullable|string|max:100',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|in:Active,Inactive',

        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'company_code.required' => 'Company Code is required.',
            'company_code.unique' => 'Company Code already exists.',

            'company_name.required' => 'Company Name is required.',

            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Email already exists.',

            'phone.required' => 'Phone number is required.',

            'website.url' => 'Please enter a valid website URL.',

            'logo.image' => 'Logo must be an image.',
            'logo.mimes' => 'Logo must be JPG, JPEG, PNG or WEBP.',
            'logo.max' => 'Logo size must not exceed 2 MB.',

            'status.required' => 'Please select status.',

        ];
    }
}