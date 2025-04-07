<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendFrogetPasswordJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $token;
    protected $email;
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }
   

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Mail::to($this->email)->send(new \App\Mail\CustomResetPassword($this->token, $this->email));

    }
}
