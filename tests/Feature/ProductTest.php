<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('products.index'));

        $response->assertStatus(200);
    }

    public function test_product_create_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('products.create'));

        $response->assertStatus(200);
    }

    public function test_product_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('products.store'), [

                'sku' => 'SKU001',
                'barcode' => '1234567890123',
                'product_name' => 'Laptop',
                'category' => 'Electronics',
                'brand' => 'Dell',
                'unit' => 'Piece',
                'cost_price' => 50000,
                'selling_price' => 60000,
                'stock' => 20,
                'minimum_stock' => 5,
                'description' => 'Test Product',
                'status' => 'Active',

            ]);

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'product_name' => 'Laptop'
        ]);
    }

    public function test_product_can_be_updated()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('products.update', $product), [

                'sku' => $product->sku,
                'barcode' => $product->barcode,
                'product_name' => 'Updated Product',
                'category' => $product->category,
                'brand' => $product->brand,
                'unit' => $product->unit,
                'cost_price' => 100,
                'selling_price' => 150,
                'stock' => 50,
                'minimum_stock' => 10,
                'description' => 'Updated',
                'status' => 'Active',

            ]);

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'product_name' => 'Updated Product'
        ]);
    }

    public function test_product_can_be_deleted()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('products.destroy', $product));

        $response->assertRedirect();

        $this->assertSoftDeleted($product);
    }

    public function test_product_can_be_restored()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $product->delete();

        $response = $this->actingAs($user)
            ->post(route('products.restore', $product->id));

        $response->assertRedirect();

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'deleted_at' => null,
        ]);
    }

    public function test_product_can_be_force_deleted()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $product->delete();

        $response = $this->actingAs($user)
            ->delete(route('products.forceDelete', $product->id));

        $response->assertRedirect();

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_product_search()
    {
        $user = User::factory()->create();

        Product::factory()->create([
            'product_name' => 'Dell Laptop'
        ]);

        Product::factory()->create([
            'product_name' => 'Samsung Mobile'
        ]);

        $response = $this->actingAs($user)
            ->get('/products?search=Dell');

        $response->assertSee('Dell Laptop');
        $response->assertDontSee('Samsung Mobile');
    }

    public function test_product_name_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('products.store'), []);

        $response->assertSessionHasErrors('product_name');
    }

    public function test_product_image_upload()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $image = UploadedFile::fake()->image('product.jpg');

        $response = $this->actingAs($user)
            ->post(route('products.store'), [

                'sku' => 'SKU100',
                'barcode' => '9876543210123',
                'product_name' => 'Laptop',
                'category' => 'Electronics',
                'brand' => 'HP',
                'unit' => 'Piece',
                'cost_price' => 50000,
                'selling_price' => 65000,
                'stock' => 10,
                'minimum_stock' => 2,
                'description' => 'Test Product',
                'status' => 'Active',
                'image' => $image,

            ]);

        $response->assertRedirect(route('products.index'));

        $response->assertSessionHasNoErrors();

        $product = Product::first();

        $this->assertNotNull($product);

        Storage::disk('public')->assertExists($product->image);
    }

    public function test_guest_cannot_access_product_module()
    {
        $response = $this->get(route('products.index'));

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_create_product()
    {
        $response = $this->post(route('products.store'));

        $response->assertRedirect('/login');
    }
}