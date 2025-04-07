<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendVerficationEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $user;
    protected $verificationUrl;
    public function __construct(User $user, $verificationUrl)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }
   

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Mail::to($this->user->email)->send(new \App\Mail\EmailVerification($this->verificationUrl, $this->user));
    }
}
