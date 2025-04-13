<?php

namespace App\Jobs;

use App\Mail\BarberShopRejected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendBarberShopRejectionEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $barbershop;
    protected $Rejection_Reason;
    protected $Rejection_Details;


    public function __construct($barbershop, $reason, $details)
    {
        $this->Rejection_Reason = $reason;
        $this->Rejection_Details = $details;
        $this->barbershop = $barbershop;
    }
    	
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->barbershop->email)->send(new BarberShopRejected($this->barbershop, $this->Rejection_Reason, $this->Rejection_Details));
    }
}
