<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\barberShop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        $paymentMethods = ['credit card', 'cash'];
        $paymentStatuses = ['paid', 'unpaid'];
        
        $futureDate = $this->faker->dateTimeBetween('now', '+2 months');
        $pastDate = $this->faker->dateTimeBetween('-2 months', 'now');
        
        // Randomly choose between past and future bookings (70% future, 30% past)
        $bookingDate = $this->faker->boolean(70) ? $futureDate : $pastDate;
        
        // Generate a booking reference
        $reference = 'BKG-' . strtoupper(substr(md5(uniqid()), 0, 12));
        
        // Generate a random time between 9am and 7pm
        $hour = $this->faker->numberBetween(9, 19);
        $minute = $this->faker->randomElement([0, 15, 30, 45]);
        $time = sprintf('%02d:%02d', $hour, $minute);
        
        return [
            'booking_reference' => $reference,
            'user_id' => User::factory(),
            'barbershop_id' => barberShop::factory(),
            'booking_date' => $bookingDate,
            'time' => $time,
            'duration' => $this->faker->randomElement([30, 45, 60, 90]),
            'status' => $this->faker->randomElement($statuses),
            'payment_status' => $this->faker->randomElement($paymentStatuses),
            'amount' => $this->faker->randomFloat(2, 20, 200),
            'payment_method' => $this->faker->randomElement($paymentMethods),
            'transaction_id' => $this->faker->boolean(30) ? $this->faker->md5() : null,
            'UserNotes' => $this->faker->boolean(40) ? $this->faker->sentence() : null,
            'barber_name' => $this->faker->name(),
        ];
    }
    
    /**
     * Indicate that the booking is confirmed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function confirmed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'confirmed',
            ];
        });
    }
    
    /**
     * Indicate that the booking is completed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
                'payment_status' => 'paid',
            ];
        });
    }
}
