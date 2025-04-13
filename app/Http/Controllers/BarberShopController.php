<?php

namespace App\Http\Controllers;

use App\Jobs\SendBarberShopReconsiderationEmail;
use App\Jobs\SendBarberShopRejectionEmail;
use App\Mail\BarberShopRejected;
use App\Mail\SendReconsiderationEmail;
use App\Models\barberShop;
use App\Http\Requests\StorebarberShopRequest;
use App\Http\Requests\UpdatebarberShopRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

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
            "avatar" => $request->file('avatar')?->store('barber-shops', 'public'),
            "cover" => $request->file('cover')?->store('barber-shops', 'public'),
            "slug" => $request->slug,
            "website" => $request->website,
            "social_links" => $request->social_links,
            "working_hours" => $request->working_hours,
            ]
        );
        return redirect()->route('barber.barberVerification')->with('success', 'Barber shop created successfully');
    }

    public function getBarberShops(){
        $barbershops= barberShop::paginate(3);
        foreach($barbershops as $barbershop){
            $barbershop->rejected_by=$barbershop->rejectedBy;
        }
        // dd($barbershops[0]->rejected_by);
         return response()->json($barbershops,200);
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

    public function barberJoin(){
        return view('barber.barberJoin');
    }
    public function barberadd(Request $request){
        $validated = $request->validate([
            "agree-terms"=>"required",
        ]);

        $user = auth()->user();
        $user->update([
            "role"=>"barber",
        ]);
        return redirect()->route('barber.barbershop.create');

    }

    public function reject(Request $request){
        
        try {
            $validated = $request->validate([
            "Rejection_Reason" => "required",
            ]);

            
            $barbershop = barberShop::find($request->shopId);
            if (!$barbershop) {
            throw new \Exception("Barber shop not found");
            }
            
            $barbershop->update([
            "is_verified" => "Rejected",
            "Rejection_Reason" => $request->Rejection_Reason,
            "Rejection_Details" => $request->Rejection_Details,
            "rejected_by"=> $request->rejected_by,
            ]);

            
            if($request->SendRejectionEmail){
            // Dispatch the job to send the rejection email
            SendBarberShopRejectionEmail::dispatch($barbershop, $request->Rejection_Reason, $request->Rejection_Details);
        }
            return response()->json([
            "message" => "Barber shop rejected successfully",
            "barbershop" => $barbershop,
            "rejected_by" => User::findOrFail($barbershop->rejected_by)->name,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
            "message" => $e->getMessage(),
            ], 400); 
        }
    }


    public function reconsider(Request $request){
        try {
            $barbershop = barberShop::findOrFail($request->shopId);
            
            $barbershop->update([
                "is_verified" => "Pending Verification",
                "reconsidered_by" => $request->reconsidered_by,
                "reconsideration_notes" => $request->notes,
            ]);

            if($request->sendEmail) {
                // Dispatch the job to send the reconsideration email
                    SendBarberShopReconsiderationEmail::dispatch($barbershop, $request->notes);
            }
            
            return response()->json([
                "message" => "Barber shop reconsidered successfully",
                "barbershop" => $barbershop
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
