<?php

namespace App\Jobs;

use App\Mail\BookingConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class sendBookingConfirmationEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $barberShop;
    protected $booking;
    public function __construct($barberShop, $booking)
    {
        $this->barberShop = $barberShop;
        $this->booking = $booking;
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->barberShop->email)->send(new BookingConfirmation($this->booking));
        
    }
}
