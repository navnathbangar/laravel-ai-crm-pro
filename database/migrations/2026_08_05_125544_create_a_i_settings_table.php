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
        Schema::create('a_i_settings', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->default('OpenAI');

            $table->string('model')->default('gpt-4.1-mini');

            $table->text('api_key');

            $table->decimal('temperature',3,2)->default(0.70);

            $table->integer('max_tokens')->default(500);

            $table->enum('status',[
                'Active',
                'Inactive'
            ])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_settings');
    }
};
