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
        Schema::table('services', function (Blueprint $table) {
            $table->enum('status', ['in_progress', 'completed', 'canceled'])->default('in_progress');
            $table->integer('total_hours')->nullable();
            $table->integer('hours_used')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('total_hours');
            $table->dropColumn('hours_used');
        });
    }
};
