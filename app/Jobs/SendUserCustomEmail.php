<?php

namespace App\Jobs;

use App\Mail\customUserEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendUserCustomEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $user;
    protected $subject;
    protected $message;
    protected $admin;
    public function __construct($user, $subject, $message, $admin=null)
    {   
        $this->user = $user;
        $this->subject = $subject;
        $this->message = $message;
        $this->admin = $admin;
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->admin) {
            
            Mail::to($this->admin->email)->send(new customUserEmail($this->user, $this->subject, $this->message));
        } else {
            Mail::to($this->user->email)->send(new customUserEmail($this->user, $this->subject, $this->message));
        }
        
    }
}
