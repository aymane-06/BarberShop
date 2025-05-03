<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\BarberShop;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Get all verified barbershops
        // $barbershops = barberShop::where('is_verified', 'Verified')->get();
        
        // foreach ($barbershops as $barbershop) {
        //     // Create 3-7 services for each barbershop
        //     $numServices = rand(3, 7);
            
        //     // Create a mix of service types
        //     $serviceTypes = ['Haircuts', 'Beard & Shave', 'Packages'];
            
        //     // Common haircut services
        //     Services::factory()->create([
        //         'barber_shop_id' => $barbershop->id,
        //         'name' => 'Classic Haircut',
        //         'price' => rand(20, 40),
        //         'duration' => 30,
        //         'type' => 'Haircuts',
        //     ]);
            
        //     Services::factory()->create([
        //         'barber_shop_id' => $barbershop->id,
        //         'name' => 'Beard Trim',
        //         'price' => rand(15, 25),
        //         'duration' => 20,
        //         'type' => 'Beard & Shave',
        //     ]);
            
        //     // Random additional services
        //     Services::factory($numServices - 2)->create([
        //         'barber_shop_id' => $barbershop->id,
        //     ]);
        // }
    }
}
