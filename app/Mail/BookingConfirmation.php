<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public string $bookingType; // 'appointment' or 'boarding'
    public $user;
    public $payment;

    public function __construct($booking, string $bookingType, $user, $payment = null)
    {
        $this->booking     = $booking;
        $this->bookingType = $bookingType;
        $this->user        = $user;
        $this->payment     = $payment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmed – FurryTails Pet Clinic',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-confirmation',
        );
    }
}
