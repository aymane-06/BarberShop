<?php

namespace App\Http\Controllers;

use App\Jobs\SendBarberShopApprouvalMail;
use App\Jobs\SendBarberShopCustomEmail;
use App\Jobs\SendBarberShopReconsiderationEmail;
use App\Jobs\SendBarberShopRejectionEmail;
use App\Mail\BarberShopApprovalMail;
use App\Mail\BarberShopRejected;
use App\Mail\customEmail;
use App\Mail\SendReconsiderationEmail;
use App\Models\barberShop;
use App\Http\Requests\StorebarberShopRequest;
use App\Http\Requests\UpdatebarberShopRequest;
use App\Models\Services;
use App\Models\User;
use App\Repositories\BarbershopRepository;
use App\Repositories\ServicesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;

class BarberShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barberShop = auth()->user()->barberShop;
        $Apointments = $barberShop?->bookings()->where('status','confirmed')->with(['user', 'services'])->get();
        return view('barber.dashboard', compact('barberShop','Apointments'));
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

    public function getBarberShops(Request $request){
        // $barbershops = barberShop::orderBy('created_at', 'desc')->paginate(3);
        // return response()->json($request->all(), 200);
        $barbershops = BarbershopRepository::getBarberShops($request->search,$request->status,$request->rating,$request->sort);
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
        // dd($barberShop->ratings()->get());
        $barberShop->ratings=$barberShop->ratings()->get();
        return view('pages.barber-detail', compact('barberShop'));
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
        // dd($request->all());
        $validated = $request->validate([
            "name" => "required",
            "description" => "required",
            "address" => "required",
            "city" => "required",
            "zip" => "required",
            "phone" => "required",
            "email" => "required|email",
            "barbers" => "required|array",
            'avatar' => 'nullable|image',
            'cover' => 'nullable|image',
            'slug' => 'required',
            'website' => 'nullable|url',
            'social_links' => 'nullable|array',
            'working_hours' => 'nullable|array',
        ]);
        if($request->avatar){
            $validated['avatar'] = $request->file('avatar')->store('barber-shops', 'public');
        }
        if($request->cover){
            $validated['cover'] = $request->file('cover')->store('barber-shops', 'public');
        }

        $barberShop->update($validated);

        return redirect()->route('barberShop.profile')->with('success', 'Barber shop updated successfully');
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

    public function approve(Request $request){
        try{   
        $barbershop = barberShop::findOrFail($request->shopId);
            $barbershop->update([
                "is_verified" => "Verified",
                "approved_by" => $request->approved_by,
                "reconsideration_notes" => $request->notes,
                "verified_at" => now(),
            ]);
            if($request->sendEmail) {
                // Dispatch the job to send the reconsideration email
                    SendBarberShopApprouvalMail::dispatch($barbershop, $request->notes);
            }

            return response()->json([

                "message" => "Barber shop approved successfully",
                "barbershop" => $barbershop
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }


    public function getBarbershopsStatistics(){
        $statistics=BarbershopRepository::getBarberShopsStatistics();
        return response()->json($statistics, 200);
    }

    public function emailOwner(Request $request){
        
        try {
            $validated = $request->validate([
                "subject" => "required",
                "message" => "required",
            ]);
            
            $barbershop = barberShop::findOrFail($request->shop_id);
            $admin = User::findOrFail($request->sent_by);
            $subject = $request->subject;
            $message = $request->message;
            $send_copy = $request->send_copy;

            // Mail::to($barbershop->email)->send(new customEmail($barbershop, $subject, $message));
            SendBarberShopCustomEmail::dispatch($barbershop,$barbershop, $subject, $message);
            
            if($send_copy) {
                // Mail::to($admin->email)->send(new customEmail($barbershop, $subject, $message));
            SendBarberShopCustomEmail::dispatch($admin,$barbershop, $subject, $message);

            }
            
            return response()->json([
                "message" => "Email sent successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to send email: " . $e->getMessage()
            ], 400);
        }
    }

    public function getWorkingHours(Request $request, barberShop $barberShop){
        // dd($barberShop->working_hours);
        $working_hours = $barberShop->working_hours;
        return response()->json($working_hours, 200);
    }

    public function getActiveBarberShops(Request $request){
        // dd('test');
        // return response()->json([
        //     $request->all(),
        // ]);

        $barbershops = BarbershopRepository::getActiveBarberShops($request->location,$request->date,$request->rating,$request->sort,$request->service, $request->price);
                    $barbershops->getCollection()->transform(function ($barbershop) {
                        $barbershop->average_rating = $barbershop->ratings()->avg('rating');
                        $barbershop->ratings_count = $barbershop->ratings()->count();
                        return $barbershop;
                    });
        return response()->json($barbershops, 200);
    }


    public function getDashboardStatistics(barberShop $barberShop){
        // dd($barberShop);
        $statistics = BarbershopRepository::barberShopDashboardStats($barberShop);
        return response()->json($statistics, 200);
    }

    public function getWeeklyRevenue(barberShop $barberShop,Request $request){
        $date = $request->date;
        $weeklyRevenue = BarbershopRepository::getWeeklyRevenue($barberShop,$date);
        return response()->json($weeklyRevenue, 200);
    }

    


    

    

    

}
