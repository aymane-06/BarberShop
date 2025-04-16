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
}
