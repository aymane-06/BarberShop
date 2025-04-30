<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\barberShop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'barberShop_id' => barberShop::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->boolean(80) ? $this->faker->paragraph() : null,
            'services' => $this->faker->boolean(70) ? $this->faker->randomElement(['Haircut', 'Beard Trim', 'Shave', 'Hair Coloring', 'Full Package']) : null,
        ];
    }
}
