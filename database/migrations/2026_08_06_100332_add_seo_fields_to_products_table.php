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
        Schema::table('products', function (Blueprint $table) {
            $table->text('meta_keywords')->nullable()->after('meta_description');

            $table->text('tags')->nullable()->after('meta_keywords');

            $table->boolean('ai_generated')->default(false)->after('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'meta_keywords',
                'tags',
                'ai_generated'
            ]);
        });
    }
};
