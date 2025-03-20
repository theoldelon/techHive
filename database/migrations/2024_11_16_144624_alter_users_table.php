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
        // Add isActive on Users Table in Database
        Schema::table('users', function (Blueprint $table) {
            $table->integer('isActive')->default(1)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reversing the migration
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('isActive');
        });
    }
};
