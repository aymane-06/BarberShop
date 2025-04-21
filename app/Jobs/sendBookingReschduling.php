<?php

namespace App\Jobs;

use App\Mail\BookingReschduling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class sendBookingReschduling implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $booking;
    public function __construct($booking)
    {
        $this->booking = $booking;
    }
   

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->booking->barberShop->email)->send(new BookingReschduling($this->booking));
        
    }
}
