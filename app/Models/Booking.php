<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
    protected $fillable = [
        'booking_reference',
        'barbershop_id',
        'user_id',
        'barber_name',
        'booking_date',
        'time',
        'duration',
        'status',
        'payment_status',
        'payment_method',
        'amount',
        'notes',
    ];
    protected $casts = [
        'booking_date' => 'datetime',
        'time' => 'datetime:H:i',
       
    ];
    public function barberShop()
    {
        return $this->belongsTo(barberShop::class, 'barbershop_id');
    }
    public function services()
    {
        return $this->belongsToMany(Services::class, 'Booking_Services', 'booking_id', 'service_id');
            
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
