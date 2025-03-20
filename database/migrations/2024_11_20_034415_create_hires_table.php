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
        Schema::create('hires', function (Blueprint $table) {
            $table->id();

            // Foreign key to the jobs table
            $table->foreignId('job_id')
                ->constrained()
                ->onDelete('cascade');

            // Foreign key to the job_applications table
            $table->foreignId('job_application_id')
                ->constrained('job_applications')
                ->onDelete('cascade');

            // Foreign key to the users table for the employer (job poster)
            $table->foreignId('employer_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Foreign key to the users table for the freelancer
            $table->foreignId('freelancer_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Additional fields
            $table->timestamp('hired_date'); // Date when freelancer was hired
            $table->timestamps(); // Laravel's created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hires');
    }
};
