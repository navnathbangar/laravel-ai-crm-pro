<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'company_code' => 'required|unique:companies,company_code',

            'company_name' => 'required|string|max:255',

            'contact_person' => 'required|string|max:255',

            'email' => 'required|email|unique:companies,email',

            'phone' => 'required|max:20',

            'website' => 'nullable|url',

            'gst_number' => 'nullable|max:20',

            'address' => 'nullable',

            'city' => 'nullable|max:100',

            'state' => 'nullable|max:100',

            'country' => 'nullable|max:100',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|in:Active,Inactive',

        ];
    }
}