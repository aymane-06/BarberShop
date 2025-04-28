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
        $total = static::getTotalBarberShops();
        $approved = static::getTotalBarberShopsApproved();
        $pending = static::getTotalBarberShopsPending();
        $rejected = static::getTotalBarberShopsRejected();
        
        // Calculate percentages
        $approvedPercentage = $total > 0 ? round(($approved / $total) * 100) : 0;
        $rejectedPercentage = $total > 0 ? round(($rejected / $total) * 100) : 0;
        
        // Get shops created in the last day
        $pendingLastDay = BarberShop::where('is_verified', 'Pending Verification')
            ->where('created_at', '>=', now()->subDay())
            ->count();
            
        // Get new shops percentage (comparing with last month)
        $lastMonthCount = BarberShop::where('created_at', '<', now()->startOfMonth())->count();
        $newBarberShopsPercentage = $lastMonthCount > 0 
            ? round((($total - $lastMonthCount) / $lastMonthCount) * 100) 
            : 0;
            
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
        $query= BarberShop::query();
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
    $query = BarberShop::query()
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

    // // Filter by available working hours on a specific date
    if (!empty($date)) {
        $dayOfWeek = strtolower(date('l', strtotime($date)));
        $query->whereRaw("JSON_EXTRACT(working_hours, '$.\"$dayOfWeek\"') IS NOT NULL")
              ->where(function ($q) use ($dayOfWeek) {
                  $q->whereRaw("JSON_EXTRACT(working_hours, '$.\"$dayOfWeek\".closed') IS NULL")
                    ->orWhereRaw("JSON_EXTRACT(working_hours, '$.\"$dayOfWeek\".closed') != 'on'");
              });
    }

    // Filter by minimum average rating
    if (!empty($rating)) {
        $query->withAvg('ratings', 'rating')
              ->having('ratings_avg_rating', '>=', $rating);
    }

    // // Filter by service type
    if (!empty($service)) {
        $query->whereHas('services', function ($q) use ($service) {
            $q->where('type', 'LIKE', "%{$service}%");
        });
    }

    // // Filter by maximum price
    if (!empty($price)) {
        $query->whereHas('services', function ($q) use ($price) {
            $q->where('price', '<=', $price);
        });
    }

    // // Sorting
    if (!empty($sort)) {
        switch ($sort) {
            case 'rating':
                $query->leftJoin('ratings', 'barber_shops.id', '=', 'ratings.barberShop_id')
                      ->select('barber_shops.*', \DB::raw('COALESCE(AVG(ratings.rating), 0) as avg_rating'))
                      ->groupBy('barber_shops.id')
                      ->orderByDesc('avg_rating');
                break;

            case 'bookings':
                $query->withCount('bookings')
                      ->orderByDesc('bookings_count');
                break;

            case 'PriceDESC':
                $query->leftJoin('services', 'barber_shops.id', '=', 'services.barberShop_id')
                      ->select('barber_shops.*', \DB::raw('MIN(services.price) as min_price'))
                      ->groupBy('barber_shops.id')
                      ->orderByDesc('min_price');
                break;

            case 'PriceASC':
                $query->leftJoin('services', 'barber_shops.id', '=', 'services.barberShop_id')
                      ->select('barber_shops.*', \DB::raw('MIN(services.price) as min_price'))
                      ->groupBy('barber_shops.id')
                      ->orderBy('min_price', 'ASC');
                break;
        }
    }

    // Return paginated results with relations
    return $query->with('services', 'ratings')
                 ->paginate(6);
}

}
