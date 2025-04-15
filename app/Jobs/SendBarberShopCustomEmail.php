<?php

namespace App\Jobs;

use App\Mail\customEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendBarberShopCustomEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $to;
    protected $barbershop;
    protected $subject;
    protected $message;

    public function __construct($to,$barbershop, $subject, $message)
    {   
        $this->to = $to;
        $this->barbershop = $barbershop;
        $this->subject = $subject;
        $this->message = $message;
      
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->to->email)->send(new customEmail($this->barbershop, $this->subject, $this->message));
        
    }
}
