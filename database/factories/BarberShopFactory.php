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
            'barbers' => [$this->faker->name()],
            'avatar' => null,
            'cover' => 'https://picsum.photos/800/600',
            'slug' => $this->faker->unique()->slug(),
            'website' => $this->faker->url(),
            'social_links' => json_encode([
                'facebook' => $this->faker->url(),
                'instagram' => $this->faker->url(),
                'twitter' => $this->faker->url(),
            ]),
            'working_hours' => [
                'monday' => ['open' => '09:04', 'close' => '22:14', 'closed' => false],
                'tuesday' => ['open' => '09:04', 'close' => '19:33', 'closed' => false],
                'wednesday' => ['open' => '09:04', 'close' => '03:55', 'closed' => false],
                'thursday' => ['open' => '09:04', 'close' => '08:50', 'closed' => false],
                'friday' => ['open' => '09:04', 'close' => '15:42', 'closed' => false],
                'saturday' => ['open' => '04:45', 'close' => '20:00', 'closed' => true],
                'sunday' => ['open' => '06:48', 'close' => '23:32', 'closed' => false],
            ],
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
