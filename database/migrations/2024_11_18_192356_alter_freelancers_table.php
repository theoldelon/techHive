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
        // Add Resume on Freelancers Table
        Schema::table('freelancers', function (Blueprint $table) {
            $table->string('resume')->after('certificate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reversing the migration
        Schema::table('freelancers', function (Blueprint $table) {
            $table->string('resume')->nullable();
        });
    }
};
