<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BarberShopRejected extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $Rejection_Reason;
    public $Rejection_Details;
    public $barbershop;

    public function __construct($barbershop,$Rejection_Reason, $Rejection_Details)
    {
        $this->Rejection_Reason = $Rejection_Reason;
        $this->Rejection_Details = $Rejection_Details;
        $this->barbershop = $barbershop;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Barber Shop Rejected',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.rejectionEmail',
            with: [
                'Rejection_Reason' => $this->Rejection_Reason,
                'Rejection_Details' => $this->Rejection_Details,
                'barbershop' => $this->barbershop,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
