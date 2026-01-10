<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment; // Fix: Import Attachment
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf; // Fix: Pastikan diletakkan di atas class

class FoodReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Variabel ini harus ada agar bisa diakses di PDF dan email

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Struk Pembayaran F&B - #' . $this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.food_receipt', // Pastikan file ini ada di resources/views/emails/
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        // Generate PDF di memori menggunakan Dompdf
        $pdf = Pdf::loadView('cart.receipt_pdf', ['order' => $this->order]);

        return [
            Attachment::fromData(fn () => $pdf->output(), 'Struk_Pesanan_' . $this->order->id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}