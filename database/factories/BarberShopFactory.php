<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\barberShop>
 */
class BarberShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->paragraph(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'barbers' => json_encode([
                
                     $this->faker->name(),
                     $this->faker->name(),
                
            ]),
            'avatar' => null,
            'cover' => null,
            'slug' => $this->faker->unique()->slug(),
            'website' => $this->faker->url(),
            'social_links' => json_encode([
                'facebook' => $this->faker->url(),
                'instagram' => $this->faker->url(),
                'twitter' => $this->faker->url(),
            ]),
            'working_hours' => json_encode([
                'monday' => ['09:00', '18:00'],
                'tuesday' => ['09:00', '18:00'],
                'wednesday' => ['09:00', '18:00'],
                'thursday' => ['09:00', '18:00'],
                'friday' => ['09:00', '18:00'],
                'saturday' => ['10:00', '16:00'],
                'sunday' => ['closed'],
            ]),
            'views' => $this->faker->numberBetween(0, 1000),
            'bookings' => $this->faker->numberBetween(0, 200),
            'reviews' => $this->faker->numberBetween(0, 100),
            'ratings_count' => $this->faker->numberBetween(0, 50),
            'ratings' => $this->faker->randomFloat(1, 1, 5),
            'is_active' => $this->faker->boolean(80),
            'is_verified' => $this->faker->randomElement(['Pending Verification', 'Verified', 'Rejected']),
            //
        ];
    }
}
