<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('sku')->unique();

            $table->string('barcode')->nullable();

            $table->string('product_name');

            $table->string('slug')->unique();

            $table->string('category')->nullable();

            $table->string('brand')->nullable();

            $table->string('unit')->default('PCS');

            $table->decimal('cost_price',10,2)->default(0);

            $table->decimal('selling_price',10,2)->default(0);

            $table->integer('stock')->default(0);

            $table->integer('minimum_stock')->default(5);

            $table->string('image')->nullable();

            $table->longText('description')->nullable();

            $table->enum('status',['Active','Inactive'])
                  ->default('Active');

            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};