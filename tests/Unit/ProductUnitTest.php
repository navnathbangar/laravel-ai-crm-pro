<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductUnitTest extends TestCase
{
    public function test_product_object_can_be_created()
    {
        $product = new Product();

        $this->assertInstanceOf(Product::class, $product);
    }

    public function test_product_uses_has_factory()
    {
        $traits = class_uses(Product::class);

        $this->assertContains(
            \Illuminate\Database\Eloquent\Factories\HasFactory::class,
            $traits
        );
    }

    public function test_product_table_name()
    {
        $product = new Product();

        $this->assertEquals(
            'products',
            $product->getTable()
        );
    }

    public function test_product_primary_key()
    {
        $product = new Product();

        $this->assertEquals('id', $product->getKeyName());
    }

    public function test_product_casts()
    {
        $product = new Product();

        $casts = $product->getCasts();

        $this->assertEquals('decimal:2', $casts['cost_price']);
        $this->assertEquals('decimal:2', $casts['selling_price']);
    }
}