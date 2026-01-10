<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class BookingSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $pdfContent;

    // Kita terima data Booking & Isi PDF dari Controller
    public function __construct(Booking $booking, $pdfContent)
    {
        $this->booking = $booking;
        $this->pdfContent = $pdfContent;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'E-Ticket Sansflix - ' . $this->booking->booking_code,
        );
    }

    // Isi emailnya (Body Text)
    public function content(): Content
    {
        // Kita pakai view sederhana saja (nanti dibuat)
        return new Content(
            view: 'emails.booking_success',
        );
    }

    // Lampirkan PDF
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'Tiket-Sansflix.pdf')
                ->withMime('application/pdf'),
        ];
    }
}