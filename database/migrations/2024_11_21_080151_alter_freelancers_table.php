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
        // Add isFeatured on Freelancers Table in Database
        Schema::table('freelancers', function (Blueprint $table) {
            $table->integer('isFeatured')->after('status')->default(0)->after('resume');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the Migration
        Schema::table('freelancers', function (Blueprint $table) {
            $table->dropColumn('isFeatured');
        });
    }
};
