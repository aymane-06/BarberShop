<?php

namespace Database\Factories;

use App\Models\barberShop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services>
 */
class ServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serviceTypes = ['Haircuts', 'Beard & Shave', 'Packages'];
        
        return [
            'barber_shop_id' => barberShop::factory(),
            'name' => $this->faker->randomElement([
                'Classic Haircut', 'Fade', 'Buzz Cut', 'Beard Trim', 
                'Hot Towel Shave', 'Hair & Beard Combo', 'VIP Package',
                'Kid\'s Haircut', 'Senior\'s Haircut', 'Hair Styling',
                'Hair Coloring', 'Luxury Shave', 'Head Massage'
            ]),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 15, 100),
            'duration' => $this->faker->randomElement([15, 30, 45, 60, 90]),
            'image' => null,
            'type' => $this->faker->randomElement($serviceTypes),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
