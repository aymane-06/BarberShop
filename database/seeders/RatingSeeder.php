<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rating;
use App\Models\Booking;
use App\Models\BarberShop;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();
        
        // // Get completed bookings to add ratings
        // $completedBookings = Booking::where('status', 'completed')->get();
        
        // foreach ($completedBookings as $booking) {
        //     // 70% chance of having a rating
        //     if (rand(1, 100) <= 70) {
        //         Rating::create([
        //             'user_id' => $booking->user_id,
        //             'barberShop_id' => $booking->barbershop_id, // Ensure this matches your database column name
        //             'rating' => rand(3, 5), // Mostly positive ratings
        //             'comment' => $faker->boolean(80) ? $faker->paragraph() : null,
        //             'services' => $booking->services ? implode(', ', $booking->services->pluck('name')->toArray()) : null,
        //         ]);
        //     }
        // }
        
        // // Add a few more random ratings
        // Rating::factory(20)->create();
        
        // // Update barber shops with rating counts and average ratings
        // $barbershops = barberShop::all();
        // foreach ($barbershops as $barbershop) {
        //     $ratings = Rating::where('barberShop_id', $barbershop->id)->get();
        //     $count = $ratings->count();
            
        //     if ($count > 0) {
        //         $avgRating = $ratings->avg('rating');
                
        //         $barbershop->ratings_count = $count;
        //         $barbershop->ratings = $avgRating;
        //         $barbershop->save();
        //     }
        // }
    }
}
