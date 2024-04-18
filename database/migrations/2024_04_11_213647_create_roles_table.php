<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'name' => 'timesync_admin', 
                'description' => 'TimeSync Administrator'
            ],
            [
                'name' => 'superadmin', 
                'description' => 'Super Administrator'
            ],
            [
                'name' => 'admin', 
                'description' => 'Administrator'
            ],
            [
                'name' => 'user', 
                'description' => 'Regular User'
            ],
            [
                'name' => 'unregistered_user', 
                'description' => 'Unregistered User'
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
