<?php

namespace App\Http\Controllers;

use App\Models\BarberShop;
use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
    public function searchResults(){

        $barberShops = barberShop::where('is_active', 1)->where('is_verified', 'Verified')->get();

      
            return view('pages.search-results', compact('barberShops'));
        
    }
}
