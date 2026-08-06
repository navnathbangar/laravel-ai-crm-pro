<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AISettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'provider' => 'required|in:OpenAI,Gemini',

            'model' => 'required|string|max:100',

            'api_key' => 'required|string',

            'temperature' => 'required|numeric|min:0|max:2',

            'max_tokens' => 'required|integer|min:1|max:8000',

            'status' => 'required|in:Active,Inactive',

        ];
    }
}