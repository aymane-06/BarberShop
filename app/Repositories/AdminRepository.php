<?php

namespace App\Repositories;

use App\Models\BarberShop;
use App\Models\Booking;
use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AdminRepository.
 */
class AdminRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }
    
    public static function AdminDashboardStats()
    {
        //user statistics
        $totalUsers = User::count();
        $newUsers = User::where('created_at', '>=', now()->startOfMonth())->count();
        $lastMonthUsers = User::where('created_at', '>=', now()->subMonth()->startOfMonth())
                              ->where('created_at', '<', now()->startOfMonth())
                              ->count();
        $percentageChange = $lastMonthUsers > 0 ? round((($newUsers - $lastMonthUsers) / $lastMonthUsers) * 100, 2)
         : round((($newUsers - $lastMonthUsers)) * 100, 2);
        //barber shop statistics
        $totalBarberShops= barberShop::where('is_verified', 'Verified')->count();
        $newBarberShops = barberShop::where('created_at', '>=', now()->startOfMonth())->count();
        $lastMonthBarberShops = barberShop::where('created_at', '>=', now()->subMonth()->startOfMonth())
                      ->where('created_at', '<', now()->startOfMonth())
                      ->count();
        $percentageChangeBarberShops = $lastMonthBarberShops > 0 ? round((($newBarberShops - $lastMonthBarberShops) / $lastMonthBarberShops) * 100, 2) 
        : round((($newBarberShops - $lastMonthBarberShops)) * 100, 2);
        //platform Revenue statistics
        $thisMonthRevenue = Booking::where('created_at', '>=', now()->startOfMonth())->sum('amount');
        $lastMonthRevenue = Booking::where('created_at', '>=', now()->subMonth()->startOfMonth())
                      ->where('created_at', '<', now()->startOfMonth())
                      ->sum('amount');
        $percentageChangeRevenue = $lastMonthRevenue > 0 ? round((($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 2)
         : round((($thisMonthRevenue - $lastMonthRevenue)) * 100, 2);
        //New Registered Users/day
        $todyNewUsers = User::where('created_at', '>=', now()->startOfDay())->count();
        $barbers= User::where('created_at', '>=', now()->startOfDay())->where('role', 'barber')->count();
        $clients= User::where('created_at', '>=', now()->startOfDay())->where('role', 'client')->count();
        return [
            'totalUsers' => $totalUsers,
            'newUsers' => $newUsers,
            'lastMonthUsers' => $lastMonthUsers,
            'percentageUserChange' => $percentageChange,
            'totalBarberShops' => $totalBarberShops,
            'newBarberShops' => $newBarberShops,
            'lastMonthBarberShops' => $lastMonthBarberShops,
            'percentageChangeBarberShops' => $percentageChangeBarberShops,
            'thisMonthRevenue' => $thisMonthRevenue,
            'lastMonthRevenue' => $lastMonthRevenue,
            'percentageChangeRevenue' => $percentageChangeRevenue,
            'todyNewUsers'=>$todyNewUsers,
            'barbers'=>$barbers,
            'clients'=>$clients
        ];
    }   

    public static function getPlatformGrowth($date){
        if($date=='Week'){
            $startDate = now()->startOfWeek(); 
            $endDate = now();
            $Users = [];
            $barberShops = [];
            $days = [];

            // Loop through each day of the week
            for ($date = clone $startDate; $date <= $endDate; $date->addDay()) {
                $dayName = $date->format('D');
                $days[] = $dayName;
                
                // Get Users for each day
                $dailyUsers = User::whereDate('created_at', $date)->count();
                    
                // Get BarberShop for each day
                $dailyBarberShops = barberShop::whereDate('created_at', $date)->where('is_verified', 'Verified')->count();
                
                $Users[] = $dailyUsers;
                $barberShops[] = $dailyBarberShops;
            }

            return [
                'days' => $days,
                'Users' => $Users,
                'barberShops' => $barberShops,
            ];
        } elseif($date=='Month'){
            $startDate = now()->startOfMonth(); 
            $endDate = now();
            $Users = [];
            $barberShops = [];
            $days = [];

            // Loop through each day of the month
            for ($date = clone $startDate; $date <= $endDate; $date->addDay()) {
                $dayName = $date->format('d');
                $days[] = $dayName;
                
                // Get Users for each day
                $dailyUsers = User::whereDate('created_at', $date)->count();
                    
                // Get BarberShop for each day
                $dailyBarberShops = barberShop::whereDate('created_at', $date)->where('is_verified', 'Verified')->count();
                
                $Users[] = $dailyUsers;
                $barberShops[] = $dailyBarberShops;
            }

            return [
                'days' => $days,
                'Users' => $Users,
                'barberShops' => $barberShops,
            ];
        } elseif($date=='Year'){
            $startDate = now()->startOfYear(); 
            $endDate = now();
            $Users = [];
            $barberShops = [];
            $months = [];

            // Loop through each month of the year
            for ($date = clone $startDate; $date <= $endDate; $date->addMonth()) {
                $monthName = $date->format('M');
                $months[] = $monthName;
                
                // Get Users for each month
                $monthlyUsers = User::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();
                    
                // Get BarberShop for each month
                $monthlyBarberShops = barberShop::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->where('is_verified', 'Verified')
                    ->count();
                
                $Users[] = $monthlyUsers;
                $barberShops[] = $monthlyBarberShops;
            }

            return [
                'months' => $months,
                'Users' => $Users,
                'barberShops' => $barberShops,
            ];
        }
    }
}

