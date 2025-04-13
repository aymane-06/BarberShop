<?php

namespace Database\Seeders;

use App\Models\barberShop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarberShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        barberShop::factory()
            ->count(10)
            ->create();
    }
}
