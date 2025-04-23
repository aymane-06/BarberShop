<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'role',
        'email_verification_token',
        'provider',
        'provider_id',
        'provider_token',
        'status',
        'last_login_at',
        'suspended_at',
        'suspended_by',
        'suspension_reason',
        'suspension_details',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected function barbershop(){
        return $this->hasOne(BarberShop::class);
    }
    protected function reconsiderBarberShops(){
        return $this->hasMany(BarberShop::class);
    }
    protected function bookings(){
        return $this->hasMany(Booking::class);
    }
    protected function ratings(){
        return $this->hasMany(Rating::class, 'user_id');
    }
}
