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
        //
        Schema::table('hires', function (Blueprint $table) {
            $table->string('progress_link')->after('hired_date')->nullable();
            $table->string('assessment_link')->after('progress_link')->nullable();
            $table->integer('hire_status')->after('assessment_link')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the Migration
        Schema::table('hires', function (Blueprint $table) {
            $table->dropColumn('progress_link');
            $table->dropColumn('assessment_link');
            $table->dropColumn('hire_status');
        });
    }
};
