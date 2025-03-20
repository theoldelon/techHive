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
        Schema::table('users', function (Blueprint $table) {
            $table->text('about')->after('isActive')->nullable();
            $table->string('education')->after('about')->nullable();
            $table->string('career_start')->after('education')->nullable();
            $table->string('experience')->after('career_start')->nullable();
            $table->text('other')->after('experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reversing the migration
        Schema::table('users', function (Blueprint $table) {
            $table->text('about')->nullable();
            $table->string('education')->nullable();
            $table->string('career_start')->nullable();
            $table->string('experience')->nullable();
            $table->text('other')->nullable();
        });
    }
};
