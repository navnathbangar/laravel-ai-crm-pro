<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Product::when($this->search, function ($query) {

                $query->where('product_name', 'like', '%' . $this->search . '%')
                      ->orWhere('sku', 'like', '%' . $this->search . '%')
                      ->orWhere('barcode', 'like', '%' . $this->search . '%')
                      ->orWhere('category', 'like', '%' . $this->search . '%')
                      ->orWhere('brand', 'like', '%' . $this->search . '%');

            })

            ->select(
                'sku',
                'product_name',
                'category',
                'brand',
                'cost_price',
                'selling_price',
                'stock',
                'status'
            )

            ->get();
    }

    public function headings(): array
    {
        return [

            'SKU',

            'Product Name',

            'Category',

            'Brand',

            'Cost Price',

            'Selling Price',

            'Stock',

            'Status',

        ];
    }
}