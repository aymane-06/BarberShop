<?php

namespace App\Repositories;

use App\Models\BarberShop;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BarbershopRepository.
 */
class BarbershopRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model(): string
    {
        return BarberShop::class;
    }

    public static function getTotalBarberShops()
    {
        return BarberShop::count();
    }

    public static function getTotalBarberShopsApproved()
    {
        return BarberShop::where('is_verified', 'Verified')->count();
    }

    public static function getTotalBarberShopsPending()
    {
        return BarberShop::where('is_verified', 'Pending Verification')->count();
    }

    public static function getTotalBarberShopsRejected()
    {
        return BarberShop::where('is_verified', 'Rejected')->count();
    }

    public static function getBarberShopsStatistics(){
        return [
            'totalBarberShops' => static::getTotalBarberShops(),
            'totalBarberShopsApproved' => static::getTotalBarberShopsApproved(),
            'totalBarberShopsPending' => static::getTotalBarberShopsPending(),
            'totalBarberShopsRejected' => static::getTotalBarberShopsRejected(),
        ];
    }
}
