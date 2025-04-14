<?php

namespace App\Jobs;

use App\Mail\BarberShopApprovalMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendBarberShopApprouvalMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $barbershop;
    protected $notes;
    public function __construct($barberShop, $notes)
    {
        $this->barbershop = $barberShop;
        $this->notes = $notes;
    }
   

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->barbershop->email)->send(new BarberShopApprovalMail($this->barbershop, $this->notes));
        
    }
}
