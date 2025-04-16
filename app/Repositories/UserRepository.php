<?php

namespace App\Repositories;

use App\Models\barberShop;
use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }
    /**
     * Get user statistics data
     *
     * @return array
     */
    public static function getUserStatistics()
    {
        return [
            'totalUsers' => User::count(),
            'newUsersPercentage' => User::count() > 0 
                ? round((User::where('created_at', '>=', now()->subDays(30))->count() / User::count()) * 100, 1) 
                : 0,
            'activeUsers' => User::where('status', 'Active')->count(),
            'activeUsersPercentage' => User::count() > 0 
                ? round((User::where('status', 'Active')->count() / User::count()) * 100, 1) 
                : 0,
            'shopOwners' => barberShop::where('is_verified', 'Verified')->count(),
            'shopOwnersPercentage' => User::count() > 0 
                ? round((barberShop::where('is_verified', 'Verified')->count() / User::count()) * 100, 1) 
                : 0,
            'suspendedUsers' => User::where('status', 'Suspended')->count(),
            'suspendedUsersPercentage' => User::count() > 0 
                ? round((User::where('status', 'Suspended')->count() / User::count()) * 100, 1) 
                : 0,
        ];
    }


    public static function getUsers($search=null, $status=null, $role=null, $sort=null)
    {
        $query = User::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
            });
        }
        
        if ($status) {
            $query->where('status', $status);
        }
        
        if ($role) {
            if ($role == 'shop_owner') {
                $query->whereHas('barbershop', function($q) {
                    $q->where('is_verified', 'Verified');
                });
            } else {
                $query->where('role', '=', $role);
            }
        }
        
        if ($sort) {
            if ($sort == 'name') {
                $query->orderBy($sort, 'asc');
            } elseif ($sort == 'last_login_at') {
                $query->orderBy($sort, 'desc');
            } else {
                $query->orderBy('created_at', $sort);
            }
        }
        
        return $query->paginate(10);
    }
    
}
