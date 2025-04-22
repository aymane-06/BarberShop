<?php

namespace App\Repositories;

use App\Models\Booking;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BookingRepository.
 */
class BookingRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Booking::class;
    }
    public static function getPendingBookings($barberShopId)
    {
        return Booking::where('barberShop_id', $barberShopId)->where('status', 'pending')->get();
    }

    public static function getConfirmedBookings($barberShopId)
    {
        return Booking::where('barberShop_id', $barberShopId)->where('status', 'confirmed')->get();
    }
    public static function getCompletedBookings($barberShopId)
    {
        return Booking::where('barberShop_id', $barberShopId)->where('status', 'completed')->get();
    }

    public static function getCancelledBookingsRate($barberShopId)
    {
        return Booking::where('barberShop_id', $barberShopId)->where('status', 'cancelled')->count() / Booking::where('barberShop_id', $barberShopId)->count() * 100;
    }
    public static function bookingStatistics($barberShopId)
    {
        $pendingBookings = self::getPendingBookings($barberShopId)->count();
        $confirmedBookings = self::getConfirmedBookings($barberShopId)->count();
        $completedBookings = self::getCompletedBookings($barberShopId)->count();
        $cancelledBookingsRate = self::getCancelledBookingsRate($barberShopId);

        return [
            'pending_bookings' => $pendingBookings,
            'confirmed_bookings' => $confirmedBookings,
            'completed_bookings' => $completedBookings,
            'cancelled_bookings_rate' => $cancelledBookingsRate,
        ];
    }


}
