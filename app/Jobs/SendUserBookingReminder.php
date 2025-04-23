<?php

namespace App\Jobs;

use App\Mail\UserBookingReminder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendUserBookingReminder implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $booking;
    public $message;
    public function __construct($booking, $message)
    {
        $this->booking = $booking;
        $this->message = $message;
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->booking->user->email)->send(new UserBookingReminder($this->booking, $this->message));

    }
}
