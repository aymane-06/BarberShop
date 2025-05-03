<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BarberShop;
use App\Models\User;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'rating',
        'comment',
    ];
    protected $casts = [
        'rating' => 'integer',
        'comment' => 'string',
    ];
    protected function User()
    {
        return $this->belongsTo(User::class);
    }
    protected function BarberShop()
    {
        return $this->belongsTo(BarberShop::class, 'barberShop_id');
    }
}
