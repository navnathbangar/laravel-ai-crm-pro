<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'sku' => 'nullable|string|max:100|unique:products,sku',

            'barcode' => 'nullable|string|max:100',

            'product_name' => 'required|string|max:255',

            'category' => 'nullable|string|max:150',

            'brand' => 'nullable|string|max:150',

            'unit' => 'required|string|max:50',

            'cost_price' => 'required|numeric|min:0',

            'selling_price' => 'required|numeric|min:0',

            'stock' => 'required|integer|min:0',

            'minimum_stock' => 'required|integer|min:0',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'description' => 'nullable|string',

            'status' => 'required|in:Active,Inactive',

        ];
    }

    public function messages(): array
    {
        return [

            'product_name.required' => 'Product Name is required.',

            'cost_price.required' => 'Cost Price is required.',

            'selling_price.required' => 'Selling Price is required.',

            'stock.required' => 'Stock is required.',

            'minimum_stock.required' => 'Minimum Stock is required.',

            'status.required' => 'Status is required.',

            'image.image' => 'Please upload a valid image.',

            'image.max' => 'Image size must not exceed 2 MB.',

        ];
    }
}