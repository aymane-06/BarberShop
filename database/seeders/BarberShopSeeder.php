<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BarberShop;
use Illuminate\Database\Seeder;

class barberShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Get all barber users
        // $barberUsers = User::where('role', 'barber')->get();
        
        // // Create a barbershop for each barber user
        // foreach ($barberUsers as $user) {
        //     barberShop::factory()->create([
        //         'user_id' => $user->id,
        //         'is_verified' => 'Verified', // Most are verified
        //     ]);
        // }
        
        // // Create some pending verification barbershops
        // $pendingUsers = User::factory(5)->create(['role' => 'barber']);
        // foreach ($pendingUsers as $user) {
        //     barberShop::factory()->create([
        //         'user_id' => $user->id,
        //         'is_verified' => 'Pending Verification',
        //     ]);
        // }
        
        // // Create a few rejected barbershops
        // $rejectedUsers = User::factory(3)->create(['role' => 'barber']);
        // foreach ($rejectedUsers as $user) {
        //     barberShop::factory()->create([
        //         'user_id' => $user->id,
        //         'is_verified' => 'Rejected',
        //         'Rejection_Reason' => 'Incomplete documentation',
        //         'rejected_by' => 1, // Admin user
        //     ]);
        // }
    }
}
