<?php

namespace App\Http\Controllers;

use App\Models\barberShop;
use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
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
    public function store(StoreRatingRequest $request,barberShop $barberShop)
    {
        // dd($request->all(),$barberShop->id);
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'service' => 'required|string|max:255',
            'review_text' => 'nullable|string|max:255',
        ]);
        $rating = new Rating();
        $rating->user_id = auth()->user()->id;
        $rating->services = $request->service;
        $rating->rating = $request->rating;
        $rating->comment = $request->review_text;
        $barberShop->ratings()->save($rating);
        return redirect()->back()->with('success', 'Rating added successfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        // dd($request->all(),$rating->id);
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'service' => 'nullable|string|max:255',
            'review_text' => 'nullable|string|max:255',
        ]);
        $rating->rating = $request->rating;
        $rating->services = $request->service;
        $rating->comment = $request->review_text;
        $rating->save();
        // dd($rating);
        return redirect()->back()->with('success', 'Rating updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
