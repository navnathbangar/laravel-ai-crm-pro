<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $leadId = $this->route('lead')?->id ?? $this->route('lead');

        return [

            'lead_code' => 'required|string|max:50|unique:leads,lead_code,' . $leadId,

            'lead_name' => 'required|string|max:255',

            'company_name' => 'nullable|string|max:255',

            'email' => 'nullable|email|max:255',

            'phone' => 'nullable|string|max:20',

            'source' => 'required|string|max:100',

            'status' => 'required|in:New,Contacted,Qualified,Proposal,Won,Lost',

            'expected_value' => 'nullable|numeric|min:0',

            'follow_up_date' => 'nullable|date',

            'notes' => 'nullable|string|max:1000',

        ];
    }
}