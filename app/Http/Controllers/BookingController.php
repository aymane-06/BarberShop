<?php

namespace App\Http\Controllers;

use App\Jobs\sendBookingCanellationEmail;
use App\Jobs\sendBookingConfirmationEmail;
use App\Jobs\sendBookingReschduling;
use App\Jobs\SendUserBookingCancelationJob;
use App\Jobs\SendUserBookingCompleted;
use App\Jobs\SendUserBookingConfirmation;
use App\Jobs\SendUserBookingReminder;
use App\Jobs\SendUserBookingReschudling;
use App\Jobs\SendUserCustomEmail;
use App\Mail\BookingCancelation;
use App\Mail\BookingConfirmation;
use App\Mail\BookingReschduling;
use App\Mail\SendUserBookingCancelation;
use App\Mail\UserBookingCompleted;
use App\Mail\UserBookingConfirmation;
use App\Mail\UserBookingReminder;
use App\Mail\UserBookingReschduling;
use App\Models\barberShop;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Services;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;

use Mail;

class BookingController extends Controller
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
    public function store(StoreBookingRequest $request,barberShop $barberShop)
    {
        // dd($barberShop->id);
        // dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'appointment_date' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1', // Assuming duration is in minutes
            'barber'=> 'nullable|string',
            'services' => 'required|array',
            'services.*' => 'exists:services,id', // Validate each service ID
        ]);
        // dd($validatedData);
        //calculate the total amount based on selected services
        $totalAmount = 0;
        foreach ($validatedData['services'] as $serviceId) {
            $service = Services::find($serviceId);
            if ($service) {
                $totalAmount += $service->price; // Assuming the service has a price attribute
            }
        }

        // Create a new booking
        $booking = Booking::create([
            'booking_reference' => 'BKG-' . strtoupper(uniqid()), // Generate a unique booking reference
            'barbershop_id' => $barberShop->id,
            'user_id' => auth()->user()->id, // Assuming you have authentication set up
            'barber_name' => $validatedData['barber'],
            'booking_date' => $validatedData['appointment_date'],
            'time' => $validatedData['hour'],
            'duration' => $validatedData['duration'],
            'status' => 'pending', // Default status
            'payment_status' => 'unpaid', // Default payment status
            'payment_method' => 'cash', // Default payment method
            'amount' => $totalAmount, // You can calculate the total amount based on selected services
            'admin_notes' => null, // Default notes
            
        ]);

        // Attach the selected services to the booking
        $booking->services()->attach($validatedData['services']);

        //send mail to the barber shop owner
        sendBookingConfirmationEmail::dispatch( $barberShop,$booking);

        // Redirect or return a response as needed
        return redirect()->route('Booking-confirm',compact('booking'))->with('success', 'Booking Confirmed!!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('pages.booking-confirm', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function cancel(UpdateBookingRequest $request, Booking $booking)
    {
        // dd($booking,$request->all());
        // Validate the request data
        $request->validate([
            'cancel_reason' => 'nullable|string|max:255',
            'notify_client'=> 'nullable|boolean',
            'notes' => 'nullable|string|max:255',
        ]);

        // Update the booking status to 'cancelled'
        $booking->update([
            'status' => 'cancelled',
            'UserNotes' => $request->input('cancel_reason'),
        ]);

        if($request->method() == 'PUT'){
            
                // Notify the client about the cancellation
                SendUserBookingCancelationJob::dispatch($booking,$request->input('cancel_reason'), $request->input('notes'));
            
            return response()->json([
                'message' => 'Booking cancelled successfully.',
                'booking' => $booking,
            ]);
        }

        sendBookingCanellationEmail::dispatch($booking);


        return redirect()->route('Booking-confirm',compact('booking'))->with('success', 'Booking cancelled successfully.');
        
    }
    public function reschedule(UpdateBookingRequest $request, Booking $booking)
    {
        // dd($booking,$request->all());
        // Validate the request data
        $request->validate([
            'new_date' => 'required|date',
            'new_time' => 'required|date_format:H:i',
            'user_notes' => 'nullable|string|max:255',
        ]);

        // Update the booking details
        $booking->update([
            'booking_date' => $request->input('new_date'),
            'time' => $request->input('new_time'),
            'UserNotes' => $request->input('user_notes'),
            'status' => 'pending', // Reset status to pending after rescheduling
        ]);
        //send mail to the barber shop owner
        sendBookingReschduling::dispatch($booking);

        return redirect()->route('Booking-confirm',compact('booking'))->with('success', 'Booking rescheduled successfully.');
    }

    public function getAppointments(barberShop $barberShop,Request $request)
    {
        // dd($barberShop->id);
        // dd($request->all());
        // Filter bookings based on the provided filters
        $filter = $request->all();
        // dd($filter);

        $appointments = BookingRepository::filterBookings($barberShop, $filter);
        return response()->json($appointments);
    }
    // {
        
    //     $appointments = $barberShop->bookings()->with(['user', 'services'])->paginate(6);

    //     return response()->json( $appointments);
    // }

    public function approve(Booking $booking,UpdateBookingRequest $request)
    {
        // Validate the request data
        $request->validate([
            'notes' => 'nullable|string|max:255',
            'notify_client' => 'nullable|boolean',
        ]);

        // Update the booking status to 'confirmed'
        $booking->update([
            'status' => 'confirmed',
            'UserNotes' => $request->input('notes'),
        ]);

        // Notify the client about the confirmation
        // sendBookingConfirmationEmail::dispatch($booking);
        SendUserBookingConfirmation::dispatch($booking, $request->input('notes'));
        return response()->json([
            'message' => 'Booking approved successfully.',
            'booking' => $booking,
        ]);
    }

    
    public function rescheduleApi(UpdateBookingRequest $request, Booking $booking)
    {
        // Validate the request data
        $request->validate([
            'new_date' => 'required|date',
            'new_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:255',
            'notify_client' => 'nullable|boolean',
        ]);

        // Update the booking details
        $booking->update([
            'booking_date' => $request->input('new_date'),
            'time' => $request->input('new_time'),
            'UserNotes' => $request->input('notes'),
            'status' => 'confirmed',
        ]);

        // Notify the client about the rescheduling
        SendUserBookingReschudling::dispatch($booking);
        return response()->json([
            'message' => 'Booking rescheduled successfully.',
            'booking' => $booking,
        ]);
    }

    public function getBookingsStatistics(barberShop $barberShop){
        $bookingStatistics = BookingRepository::bookingStatistics($barberShop->id);
        return response()->json($bookingStatistics);
    }

    public function getConfirmedAppointments(Request $request, barberShop $barberShop){
        // dd($barberShop->working_hours);
        $confirmed_appointments = $barberShop->bookings()->where('status','confirmed')->with(['user', 'services'])->get();
        return response()->json($confirmed_appointments, 200);
    }
    public function complete(Request $request, Booking $booking){
        // Validate the request data
        $request->validate([
            'notes' => 'nullable|string|max:255',
            'notify_client' => 'nullable|boolean',
        ]);

        // Update the booking status to 'completed'
        $booking->update([
            'status' => 'completed',
            'UserNotes' => $request->input('notes'),
            'payment_status' => 'paid', // Update payment status if needed
            'payment_method' => 'cash', // Update payment method if needed
        ]);

        // Notify the client about the completion
        SendUserBookingCompleted::dispatch($booking);
        // SendUserBookingReschudling::dispatch($booking);
        return response()->json([
            'message' => 'Booking completed successfully.',
            'booking' => $booking,
        ]);
    }

    public function remind(Booking $booking, Request $request){
        // Validate the request data
        // dd($booking,$request->all());
        $validated = $request->validate([
            'notes' => 'nullable|string|max:255',
        ]);
        
        // Fix: Extract the message string from the validated array
        $message = $validated['notes'] ?? 'Your appointment is coming up soon!';
        
        // Mail::to($booking->user->email)->send(new UserBookingReminder($booking, $message));
        SendUserBookingReminder::dispatch($booking, $message);
        
        return response()->json([
            'message' => 'Reminder sent successfully.',
            'booking' => $booking,
        ],200);
    }
    
}