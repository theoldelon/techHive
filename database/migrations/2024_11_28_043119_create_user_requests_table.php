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
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('job_id');
            $table->string('job_title');
            $table->string('amount_payable');
            $table->string('reference_id');
            $table->string('bank_name')->nullable();
            $table->integer('payment_method')->default(0);
            $table->string('proof')->nullable();
            $table->integer('status')->default(0);
            $table->integer('isPaid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_requests');
    }
};
