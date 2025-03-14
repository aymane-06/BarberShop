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
        Schema::create('barber_shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->unique();
            $table->text('description');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->string('phone');
            $table->string('email');
            $table->json('barbers');
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('slug')->unique();
            $table->string('website')->nullable();
            $table->json('social_links')->nullable();
            $table->json('working_hours');
            $table->integer('views')->default(0);
            $table->integer('bookings')->default(0);
            $table->integer('reviews')->default(0);
            $table->integer('ratings_count')->default(0);
            $table->float('ratings')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barber_shops');
    }
};
