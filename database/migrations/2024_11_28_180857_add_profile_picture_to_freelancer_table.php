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
        Schema::table('freelancers', function (Blueprint $table) {
            // Add a new column 'profile_picture' of type string
            $table->string('profile_picture')->nullable()->after('valid_id'); // 'name' can be replaced with the column after which you want to add the new column
        });
    }
    
    public function down(): void
    {
        Schema::table('freelancers', function (Blueprint $table) {
            // Drop the column 'profile_picture' if rolling back the migration
            $table->dropColumn('profile_picture');
        });
    }
    
};
