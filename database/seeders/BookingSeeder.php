<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\Models\barberShop;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Get verified barbershops
        // $barbershops = barberShop::where('is_verified', 'Verified')->get();
        
        // // Get regular users
        // $users = User::where('role', 'user')->get();
        
        // foreach ($barbershops as $barbershop) {
        //     // Create 5-20 bookings for each barbershop
        //     $numBookings = rand(5, 20);
            
        //     for ($i = 0; $i < $numBookings; $i++) {
        //         // Select a random user
        //         $user = $users->random();
                
        //         // Get services from this barbershop
        //         $services = Services::where('barber_shop_id', $barbershop->id)->get();
                
        //         if ($services->count() === 0) {
        //             continue; // Skip if no services
        //         }
                
        //         // Pick 1-3 random services
        //         $selectedServices = $services->random(rand(1, min(3, $services->count())));
                
        //         // Calculate total amount and duration
        //         $totalAmount = $selectedServices->sum('price');
        //         $totalDuration = $selectedServices->sum('duration');
                
        //         // Create the booking
        //         $booking = Booking::factory()->create([
        //             'user_id' => $user->id,
        //             'barbershop_id' => $barbershop->id,
        //             'amount' => $totalAmount,
        //             'duration' => $totalDuration,
        //         ]);
                
        //         // Attach services to booking
        //         foreach ($selectedServices as $service) {
        //             $booking->services()->attach($service->id);
        //         }
        //     }
        // }
    }
}
