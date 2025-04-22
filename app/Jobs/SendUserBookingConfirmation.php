<?php

namespace App\Jobs;

use App\Mail\UserBookingConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendUserBookingConfirmation implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $booking;
    protected $notes;

    public function __construct($booking, $notes = null)
    {
        $this->booking = $booking;
        $this->notes = $notes;
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->booking->user->email)->send(new UserBookingConfirmation($this->booking, $this->notes));
        
    }
}
