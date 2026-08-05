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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_code')->unique();

            $table->string('lead_name');

            $table->string('company_name')->nullable();

            $table->string('email')->nullable();

            $table->string('phone',20)->nullable();

            $table->string('source')->nullable();

            $table->enum('status',[
                'New',
                'Contacted',
                'Qualified',
                'Proposal',
                'Won',
                'Lost'
            ])->default('New');

            $table->decimal('expected_value',12,2)->default(0);

            $table->date('follow_up_date')->nullable();

            $table->text('notes')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
