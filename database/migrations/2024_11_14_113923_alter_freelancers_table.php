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
        // Add isVerified on Freelancers Table in Database
        Schema::table('freelancers', function (Blueprint $table) {
            $table->integer('isVerified')->after('certificate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancers', function (Blueprint $table) {
            $table->dropColumn('isVerified');
        });
    }
};
