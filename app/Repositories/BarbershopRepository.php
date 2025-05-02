<?php

namespace App\Repositories;

use App\Models\barberShop;
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
        return barberShop::class;
    }

    public static function getTotalBarberShops()
    {
        return barberShop::count();
    }

    public static function getTotalBarberShopsApproved()
    {
        return barberShop::where('is_verified', 'Verified')->count();
    }

    public static function getTotalBarberShopsPending()
    {
        return barberShop::where('is_verified', 'Pending Verification')->count();
    }

    public static function getTotalBarberShopsRejected()
    {
        return barberShop::where('is_verified', 'Rejected')->count();
    }

    public static function getBarberShopsStatistics(){
        $total = static::getTotalBarberShops();
        $approved = static::getTotalBarberShopsApproved();
        $pending = static::getTotalBarberShopsPending();
        $rejected = static::getTotalBarberShopsRejected();
        
        // Calculate percentages
        $approvedPercentage = $total > 0 ? round(($approved / $total) * 100) : 0;
        $rejectedPercentage = $total > 0 ? round(($rejected / $total) * 100) : 0;
        
        // Get shops created in the last day
        $pendingLastDay = barberShop::where('is_verified', 'Pending Verification')
            ->where('created_at', '>=', now()->subDay())
            ->count();
            
        // Get new shops percentage (comparing with last month)
        $lastMonthCount = barberShop::where('created_at', '<', now()->startOfMonth())->count();
        $newBarberShopsPercentage = $lastMonthCount > 0 
            ? round((($total - $lastMonthCount) / $lastMonthCount) * 100) 
            : round(($total*100));
            
        return [
            'totalBarberShops' => $total,
            'totalBarberShopsPending' => $pending,
            'totalBarberShopsApproved' => $approved,
            'totalBarberShopsRejected' => $rejected,
            'newBarberShopsPercentage' => $newBarberShopsPercentage,
            'pendingLastDay' => $pendingLastDay,
            'approvedPercentage' => $approvedPercentage,
            'rejectedPercentage' => $rejectedPercentage,
        ];
    }

    public static function getBarberShops($search=null,$status=null,$rating=null,$sort=null)
    {
        $query= barberShop::query();
        if ($search){
                $query->where('name', 'LIKE', "%$search%");
        }
        if ($status){
            $query->where('is_verified', $status);
        }
        if ($rating){
            $query->where('ratings', '>=', $rating);
        }
        if ($sort){
            if ($sort == 'name'){
                $query->orderBy($sort, 'asc');
            }else{
            $query->orderBy('created_at', $sort);
        }
    }
    
    
        return $query->paginate(3);
    }
    // date: "2025-04-26"location: "tes"page: "1"price: "99"rating: "5"service: "Haircuts"
    public static function getActiveBarberShops($search = null, $date = null, $rating = null, $sort = null, $service = null, $price = null)
    {
        $query = barberShop::query()
            ->where('is_verified', 'Verified')
            ->where('is_active', 1);
    
        // Search by name, address, city, or zip
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%")
                  ->orWhere('city', 'LIKE', "%{$search}%")
                  ->orWhere('zip', 'LIKE', "%{$search}%");
            });
        }
    
        // Filter by available working hours on a specific date
        if (!empty($date)) {
            $dayOfWeek = strtolower(date('l', strtotime($date)));
            $query->whereRaw("JSON_EXTRACT(working_hours, '$.\"$dayOfWeek\"') IS NOT NULL")
                  ->where(function ($q) use ($dayOfWeek) {
                      $q->whereRaw("JSON_EXTRACT(working_hours, '$.\"$dayOfWeek\".closed') IS NULL")
                        ->orWhereRaw("JSON_EXTRACT(working_hours, '$.\"$dayOfWeek\".closed') != 'on'");
                  });
        }
    
        // Add withAvg if rating filter or sorting by rating
        if (!empty($rating) || $sort === 'rating') {
            $query->withAvg('ratings', 'rating');
        }
    
        // Filter by minimum average rating
        if (!empty($rating)) {
            $query->having('ratings_avg_rating', '>=', $rating);
        }
    
        // Filter by service type
        if (!empty($service)) {
            $query->whereHas('services', function ($q) use ($service) {
                $q->where('type', 'LIKE', "%{$service}%");
            });
        }
    
        // Filter by maximum price
        if (!empty($price)) {
            $query->whereHas('services', function ($q) use ($price) {
                $q->where('price', '<=', $price);
            });
        }
    
        // Sorting logic
        switch ($sort) {
            case 'rating':
                $query->orderByDesc('ratings_avg_rating');
                break;
    
            case 'bookings':
                $query->withCount('bookings')
                      ->orderByDesc('bookings_count');
                break;
    
            case "PriceDESC":
                $query->withAvg('services','price')->groupBy('barber_shops.id')
                      ->orderBy('services_avg_price', 'DESC');
                break;
    
            case "PriceASC":
                $query->withAvg('services','price')->groupBy('barber_shops.id')
                      ->orderBy('services_avg_price', 'ASC');
                break;
    
            default:
                // If no sorting is provided, you can default to some other logic (e.g., alphabetical or by id)
                $query->orderBy('name');
                break;
        }
    
        // Return paginated results with relations
        return $query->with('services', 'ratings')
                     ->paginate(6);
    }
    



    public static function getTodaysBookings(BarberShop $barberShop)  {
        $todaysTotalBooking=$barberShop->bookings()->whereDate('created_at', now())->count();
        $todaysTotalBookingPercentage= $barberShop->bookings()->count() > 0 ? round(($todaysTotalBooking / $barberShop->bookings()->whereDate('created_at', now()->subDay())->count()) * 100) : 0;

    }
    public static function barberShopDashboardStats($barberShop){
         $todaysTotalBooking=$barberShop->bookings()->whereDate('created_at', now())->count();
         $todaysTotalBookingPercentage= $barberShop->bookings()->whereDate('created_at', now()->subDay())->count() > 0 ? round(($todaysTotalBooking / $barberShop->bookings()->whereDate('created_at', now()->subDay())->count()) * 100) : 0;
         $weeklyRevenue=$barberShop->bookings()->whereDate('created_at', '>=', now()->startOfWeek())->where('status','completed')->sum('amount');
         $weeklyRevenuePercentage= $barberShop->bookings()->whereDate('created_at', '>=', now()->startOfWeek()->subDays(7))->count() > 0 ? round(($weeklyRevenue / $barberShop->bookings()->whereDate('created_at', '>=', now()->subDays(14))->sum('amount')) * 100) : 0;
         $newClients=$barberShop->bookings()->whereDate('created_at', '>=', now()->subDays(30))->where('status','completed')->distinct('user_id')->count('user_id');
         $newClientsPercentage= $barberShop->bookings()->whereDate('created_at', '>=', now()->subDays(60))->count() > 0 ? round(($newClients / $barberShop->bookings()->whereDate('created_at', '>=', now()->subDays(60))->where('status','completed')->distinct('user_id')->count('user_id')) * 100) : 0;
         $avgRating=$barberShop->ratings()->avg('rating');
         return [
            'todaysTotalBooking' => $todaysTotalBooking,
            'todaysTotalBookingPercentage' => $todaysTotalBookingPercentage,
            'weeklyRevenue' => $weeklyRevenue,
            'weeklyRevenuePercentage' => $weeklyRevenuePercentage,
            'newClients' => $newClients,
            'newClientsPercentage' => $newClientsPercentage,
            'avgRating' => $avgRating,
         ];
    }

    public static function getWeeklyRevenue($barberShop,$date){
        if($date=='Week'){
        $startDate = now()->startOfWeek(); 
        $endDate = now();
        $revenues = [];
        $days = [];

        // Loop through each day of the week
        for ($date = clone $startDate; $date <= $endDate; $date->addDay()) {
            $dayName = $date->format('D');
            $days[] = $dayName;
            
            // Get revenue for each day
            $dailyRevenue = $barberShop->bookings()
                ->whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('amount');
            // Get appointments for each day
            $dailyAppointments = $barberShop->bookings()
                ->whereDate('created_at', $date)
                ->where('status', 'completed')
                ->count();
            $appointments[] = $dailyAppointments;
            $revenues[] = $dailyRevenue;
        }

        return [
            'days' => $days,
            'revenues' => $revenues,
            'appointments' => $appointments,
        ];
    }elseif($date=='Month'){
        $startDate = now()->startOfMonth(); 
        $endDate = now();
        $revenues = [];
        $days = [];

        // Loop through each day of the month
        for ($date = clone $startDate; $date <= $endDate; $date->addDay()) {
            $dayName = $date->format('D');
            $days[] = $dayName;
            
            // Get revenue for each day
            $dailyRevenue = $barberShop->bookings()
                ->whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('amount');
            // Get appointments for each day
            $dailyAppointments = $barberShop->bookings()
                ->whereDate('created_at', $date)
                ->where('status', 'completed')
                ->count();
            $appointments[] = $dailyAppointments;
            $revenues[] = $dailyRevenue;
        }

        return [
            'days' => $days,
            'revenues' => $revenues,
            'appointments' => $appointments,
        ];
    
    }elseif($date=='Year'){
        $startDate = now()->startOfYear(); 
        $endDate = now();
        $revenues = [];
        $months = [];

        // Loop through each month of the year
        for ($date = clone $startDate; $date <= $endDate; $date->addMonth()) {
            $monthName = $date->format('M');
            $months[] = $monthName;
            
            // Get revenue for each month
            $monthlyRevenue = $barberShop->bookings()
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'completed')
                ->sum('amount');
            // Get appointments for each month
            $monthlyAppointments = $barberShop->bookings()
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'completed')
                ->count();
            $appointments[] = $monthlyAppointments;
            $revenues[] = $monthlyRevenue;
        }

        return [
            'months' => $months,
            'revenues' => $revenues,
            'appointments' => $appointments,
        ];
    }

}
}