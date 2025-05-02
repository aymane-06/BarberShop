<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'super-admin',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);
        
        // // Create some barber shop owners
        // User::factory(10)->create([
        //     'role' => 'barber',
        //     'status' => 'Active',
        //     'email_verified_at' => now(),
        // ]);
        
        // // Create regular users
        // User::factory(50)->create([
        //     'role' => 'user',
        //     'status' => 'Active',
        //     'email_verified_at' => now(),
        // ]);
        
        // // Create a few inactive/suspended users
        // User::factory(5)->create([
        //     'status' => 'Inactive',
        // ]);
        
        // User::factory(3)->create([
        //     'status' => 'Suspended',
        //     'suspended_at' => now()->subDays(rand(1, 30)),
        //     'suspended_by' => 1, // Admin user
        //     'suspension_reason' => 'Violation of terms',
        // ]);
    }
}