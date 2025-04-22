<?php

namespace App\Jobs;

use App\Mail\UserBookingReschduling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendUserBookingReschudling implements ShouldQueue
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
        Mail::to($this->booking->user->email)->send(new UserBookingReschduling($this->booking));
        
    }
}
