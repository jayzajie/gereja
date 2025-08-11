<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Baptism;

class BaptismStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $baptism;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Baptism $baptism, $status)
    {
        $this->baptism = $baptism;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match($this->status) {
            'approved' => 'Pendaftaran Baptis Anda Telah Disetujui',
            'rejected' => 'Pendaftaran Baptis Anda Ditolak',
            default => 'Update Status Pendaftaran Baptis'
        };

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.baptism-status-notification',
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
