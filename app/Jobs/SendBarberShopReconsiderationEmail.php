<?php

namespace App\Jobs;

use App\Mail\SendReconsiderationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendBarberShopReconsiderationEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $barbershop;
    protected $reconsideration_notes;
    public function __construct($barberShop, $reconsideration_notes)
    {
        $this->reconsideration_notes = $reconsideration_notes;
        $this->barbershop = $barberShop;
    }
   

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->barbershop->email)->send(new SendReconsiderationEmail($this->barbershop, $this->reconsideration_notes));
        
    }
}
