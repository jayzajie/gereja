<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;

class MemberStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Member $member, $status)
    {
        $this->member = $member;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match($this->status) {
            'approved' => 'Pendaftaran Keanggotaan Anda Telah Disetujui',
            'rejected' => 'Pendaftaran Keanggotaan Anda Ditolak',
            'active' => 'Keanggotaan Anda Telah Diaktifkan',
            'inactive' => 'Keanggotaan Anda Dinonaktifkan',
            default => 'Update Status Keanggotaan'
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
            view: 'emails.member-status-notification',
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
