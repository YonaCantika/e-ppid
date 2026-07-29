<?php

namespace App\Mail;

use App\Models\Pemohon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pemohon;

    /**
     * Create a new message instance.
     */
    public function __construct(Pemohon $pemohon)
    {
        $this->pemohon = $pemohon;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi Akun - e-PPID PT Garam',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Generate Signed URL valid selama 24 jam
        $signedUrl = \Illuminate\Support\Facades\URL::temporarySignedRoute(
            'verifikasi.link',
            now()->addHours(24),
            ['id' => $this->pemohon->id_pemohon, 'hash' => sha1($this->pemohon->email)]
        );

        return new Content(
            view: 'emails.verifikasi_otp',
            with: [
                'nama' => $this->pemohon->nama,
                'email' => $this->pemohon->email,
                'kode_otp' => $this->pemohon->kode_unik,
                'url_verifikasi' => $signedUrl,
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
