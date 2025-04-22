<?php

namespace App\Jobs;

use App\Mail\SendUserBookingCancelation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendUserBookingCancelationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $booking;
    protected $CancelationReason;
    protected $notes;
    public function __construct($booking, $CancelationReason, $notes=null)
    {
        $this->booking = $booking;
        $this->CancelationReason = $CancelationReason;
        $this->notes = $notes;
    }
    
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->booking->user->email)->send(new SendUserBookingCancelation($this->booking, $this->CancelationReason, $this->notes));
        
    }
}
