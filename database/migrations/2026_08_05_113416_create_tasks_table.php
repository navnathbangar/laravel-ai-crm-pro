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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_code')->unique();

            $table->string('title');

            $table->text('description')->nullable();

            $table->string('assigned_to')->nullable();

            $table->enum('priority', [

                'Low',
                'Medium',
                'High'

            ])->default('Medium');

            $table->enum('status', [

                'Pending',
                'In Progress',
                'Completed',
                'Cancelled'

            ])->default('Pending');

            $table->date('start_date');

            $table->date('due_date');

            $table->timestamp('completed_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
