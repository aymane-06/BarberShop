<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class barberShop extends Model
{
    /** @use HasFactory<\Database\Factories\BarberShopFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'city',
        'zip',
        'phone',
        'email',
        'barbers',
        'avatar',
        'cover',
        'slug',
        'website',
        'social_links',
        'working_hours',
        'views',
        'bookings',
        'reviews',
        'ratings_count',
        'ratings',
        'is_active',
        'is_verified',
        'verified_at',
        'Rejection_Reason',
        'Rejection_Details',
        'rejected_by',
        'reconsidered_by',
        'reconsideration_notes',
        'approved_by',
    ];

    protected $casts = [
        'barbers' => 'array',
        'social_links' => 'array',
        'working_hours' => 'array',
        'verified_at' => 'datetime',
    ];
    protected function user(){
        return $this->belongsTo(User::class);
    }
    protected function rejectedBy(){
        return $this->belongsTo(User::class, 'rejected_by');
    }
    protected function reconsideredBy(){
        return $this->belongsTo(User::class, 'reconsidered_by');
    }
    protected function approvedBy(){
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function services(){
        return $this->hasMany(Services::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'barbershop_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'barbershop_id', 'id');
    }

    

}
