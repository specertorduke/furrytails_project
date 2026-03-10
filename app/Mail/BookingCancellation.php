<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingCancellation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public string $bookingType; // 'appointment' or 'boarding'
    public $user;

    public function __construct($booking, string $bookingType, $user)
    {
        $this->booking     = $booking;
        $this->bookingType = $bookingType;
        $this->user        = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Cancelled – FurryTails Pet Clinic',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-cancellation',
        );
    }
}
