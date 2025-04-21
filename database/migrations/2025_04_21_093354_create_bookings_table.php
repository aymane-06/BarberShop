<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique(); // Unique booking number
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('barbershop_id')->constrained('barber_shops')->onDelete('cascade');
            $table->dateTime('booking_date');
            $table->time('time')->nullable(); // Time of the booking
            $table->integer('duration')->nullable(); // Duration in minutes
            $table->enum('status',['pending', 'confirmed', 'completed', 'cancelled'])->default('pending'); // pending, confirmed, completed, cancelled
            $table->enum('payment_status',['unpaid', 'paid'])->default('unpaid'); // unpaid, paid
            $table->decimal('amount', 8, 2);
            $table->enum('payment_method',['credit card', 'cash'])->nullable(); // e.g., credit card, cash
            $table->string('transaction_id')->nullable(); // for tracking payment transactions
            $table->text('UserNotes')->nullable(); // additional notes from the user
            $table->string('barber_name')->nullable(); // name of the barber assigned to the booking
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
