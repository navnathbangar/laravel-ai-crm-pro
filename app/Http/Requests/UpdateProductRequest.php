<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')->id;

        return [

            'sku' => 'nullable|string|max:100|unique:products,sku,' . $productId,

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

            'meta_title' => 'nullable|string',

            'meta_description' => 'nullable|string',

            'meta_keywords' => 'nullable|string',

            'tags' => 'nullable|string',

            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required|in:Active,Inactive',

        ];
    }
}