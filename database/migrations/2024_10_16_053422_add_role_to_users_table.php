<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user'); 
            $table->boolean('is_super_admin')->default(false);
        });

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('admin!@#1'),
            'is_super_admin' => true, // Set the super admin flag to true
            'role'=> "admin",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
              // Optionally, delete the super admin user when rolling back
       DB::table('users')->where('email', 'superadmin@example.com')->delete();
    }
};
