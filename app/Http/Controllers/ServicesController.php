<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use Illuminate\Http\Request;

class ServicesController extends Controller
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
    public function store(StoreServicesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicesRequest $request, Services $services)
    {   
        
        try {
            // Get validated data
            $validated = request()->validate([
                "name" => "nullable|string",
                "description" => "nullable|string",
                "price" => "nullable|numeric",
                "duration" => "nullable|integer",
                "image" => "nullable|image",
                "type" => "nullable|in:Haircuts,Beard & Shave,Packages",
                "is_active" => "nullable|boolean",
            ]);

            // Handle image upload if present
            if ($request->hasFile('image')) {
                // Store the image and get the path
                $imagePath = $request->file('image')->store('services', 'public');
                $validated['image'] = $imagePath;
            }

            // Update service attributes
            $services->update($validated);

            // Return a response
            return response()->json([
                'message' => 'Service updated successfully',
                'service' => $services
            ], 200);
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'message' => 'Error updating service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Services $services)
    {
        try {
            if($request->shopId != $services->barber_shop_id){
                return response()->json([
                    'message' => 'You are not authorized to delete this service'
                ], 403);
            }
            $services->delete();
            return response()->json([
            'message' => 'Service deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
            'message' => 'Error deleting service',
            'error' => $e->getMessage()
            ], 500);
        }
    }

    public function toggle(Request $request,Services $services)
    {
        try {
            if($request->shopId != $services->barber_shop_id){
                return response()->json([
                    'message' => 'You are not authorized to toggle this service'
                ], 403);
            }
            $services->is_active = !$request->is_active;
            $services->save();
            return response()->json([
                'message' => 'Service status updated successfully',
                'service' => $services
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating service status',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }
}
