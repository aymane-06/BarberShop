<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BarberShop;
use App\Models\Booking;

class Services extends Model
{
    /** @use HasFactory<\Database\Factories\ServicesFactory> */
    use HasFactory;

    protected $fillable = [
        'barber_shop_id',
        'name',
        'description',
        'price',
        'duration',
        'image',
        'type',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'duration' => 'integer',
        'price' => 'decimal:2',
    ];
    public function barberShop()
    {
        return $this->belongsTo(BarberShop::class);
    }
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'Booking_Services', 'service_id', 'booking_id');
    }
}


