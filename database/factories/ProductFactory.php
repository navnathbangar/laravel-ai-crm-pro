<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'sku' => fake()->unique()->bothify('SKU-#####'),
            'barcode' => fake()->unique()->ean13(),
            'product_name' => fake()->words(3, true),
            'category' => fake()->randomElement([
                'Electronics',
                'Clothing',
                'Furniture',
                'Books',
                'Sports'
            ]),
            'brand' => fake()->company(),
            'unit' => fake()->randomElement([
                'Piece',
                'Kg',
                'Gram',
                'Liter',
                'Pack',
                'Box'
            ]),
            'cost_price' => fake()->randomFloat(2, 100, 10000),
            'selling_price' => fake()->randomFloat(2, 150, 15000),
            'stock' => fake()->numberBetween(0, 500),
            'minimum_stock' => fake()->numberBetween(5, 50),
            'image' => null, // Factory image upload नहीं करती
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement([
                'Active',
                'Inactive'
            ]),
        ];
    }
}