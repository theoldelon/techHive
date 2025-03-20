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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('valid_id')->nullable();
            $table->string('selfie_with_id')->nullable();
            $table->string('business_permit')->nullable();
            $table->string('dti_registration')->nullable();
            $table->string('sec_registration')->nullable();
            $table->integer('isVerified')->default(0);
            $table->integer('isFeatured')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
