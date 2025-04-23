<?php

namespace App\Jobs;

use App\Mail\UserBookingCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendUserBookingCompleted implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $booking;
    public function __construct($booking)
    {
        $this->booking = $booking;
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->booking->user->email)->send(new UserBookingCompleted($this->booking));
        
    }
}
