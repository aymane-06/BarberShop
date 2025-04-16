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
}
