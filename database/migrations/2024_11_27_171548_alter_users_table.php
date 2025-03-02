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
        // Add Portfolio and Socials 
        Schema::table('users', function (Blueprint $table) {
            $table->string('portfolio')->after('other')->nullable();
            $table->string('facebook')->after('portfolio')->nullable();
            $table->string('instagram')->after('facebook')->nullable();
            $table->string('twitter')->after('instagram')->nullable();
            $table->string('tiktok')->after('twitter')->nullable();
            $table->string('youtube')->after('tiktok')->nullable();
            $table->string('github')->after('youtube')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reversing the migration
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('portfolio');
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('twitter');
            $table->dropColumn('tiktok');
            $table->dropColumn('youtube');
            $table->dropColumn('github');
        });
    }
};
