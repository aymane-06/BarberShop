<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $statistics= AdminRepository::AdminDashboardStats();
        $totalUsers = $statistics['totalUsers'];
        $percentageUserChange = $statistics['percentageUserChange'];
        $totalBarberShops = $statistics['totalBarberShops'];
        $percentageChangeBarberShops = $statistics['percentageChangeBarberShops'];
        $thisMonthRevenue = $statistics['thisMonthRevenue'];
        $percentageChangeRevenue = $statistics['percentageChangeRevenue'];
        $todyNewUsers = $statistics['todyNewUsers'];
        $barbersCount = $statistics['barbers'];
        $clientsCount = $statistics['clients'];
        return view('admin.dashboard', compact('totalUsers', 'percentageUserChange', 'totalBarberShops', 'percentageChangeBarberShops', 'thisMonthRevenue', 'percentageChangeRevenue','todyNewUsers','barbersCount','clientsCount'));
    }
}
