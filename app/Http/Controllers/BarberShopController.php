<?php

namespace App\Http\Controllers;

use App\Models\barberShop;
use App\Http\Requests\StorebarberShopRequest;
use App\Http\Requests\UpdatebarberShopRequest;

class BarberShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebarberShopRequest $request)
    {
        // dd($request->all());
        barberShop::create([
            "user_id" => auth()->user()->id,
            "name" => $request->name,
            "description" => $request->description,
            "address" => $request->address,
            "city" => $request->city,
            "zip" => $request->zip,
            "phone" => $request->phone,
            "email" => $request->email,
            "barbers" => $request->barbers,
            "avatar" => $request->file('avatar')->store('barber-shops'),
            "cover" => $request->file('cover')->store('barber-shops'),
            "slug" => $request->slug,
            "website" => $request->website,
            "social_links" => $request->social_links,
            "working_hours" => $request->working_hours,
            ]
        );
        return redirect()->route('barber.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(barberShop $barberShop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(barberShop $barberShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarberShopRequest $request, barberShop $barberShop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barberShop $barberShop)
    {
        //
    }
}
