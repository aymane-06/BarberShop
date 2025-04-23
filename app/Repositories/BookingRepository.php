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
    public static function filterBookings($barberShop, $filter=[])
    {
        // dd($barberShop->id,$filter);
        $bookings = $barberShop->bookings()->with(['user', 'services']);

        if(isset($filter['search']) && !empty($filter['search'])) {
            $search = $filter['search'];
            $bookings = $bookings->whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                      ->orWhere('phone', 'like', '%'.$search.'%');
            })->orWhere('booking_reference', 'like', '%'.$search.'%')
              ->orWhereHas('services', function($query) use ($search) {
                  $query->where('name', 'like', '%'.$search.'%');
              });
        }

        if(isset($filter['status']) && !empty($filter['status'])) {
            $bookings = $bookings->where('status', $filter['status']);
        }
        
        if (isset($filter['date_filter']) && !empty($filter['date_filter'])) {
            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime('+1 day'));
            $weekEnd = date('Y-m-d', strtotime('+1 week'));
                
            if ($filter['date_filter'] == 'today') {
                // Today's bookings
                $bookings = $bookings->whereRaw('DATE(booking_date) = ?', [$today]);
            } elseif ($filter['date_filter'] == 'tomorrow') {
                // Tomorrow's bookings
                $bookings = $bookings->whereDate('booking_date', $tomorrow);
            } elseif ($filter['date_filter'] == 'week') {
                // This week's bookings (from today to next 7 days)
                $bookings = $bookings->whereDate('booking_date', '>=', $today)
                            ->whereDate('booking_date', '<=', $weekEnd);
            } elseif ($filter['date_filter'] == 'past') {
                // Past appointments (before today)
                $bookings = $bookings->whereDate('booking_date', '<', $today);
            } elseif (is_string($filter['date_filter']) && ($timestamp = strtotime($filter['date_filter'])) !== false) {
                // If it's a valid date string, convert it to Y-m-d format
                $specificDate = date('Y-m-d', $timestamp);
                $bookings = $bookings->whereDate('booking_date', $specificDate);
            }
        }

        return $bookings->orderBy('booking_date', 'DESC')->paginate(10);
    }
}
