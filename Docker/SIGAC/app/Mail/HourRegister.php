<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class HourRegister extends Mailable { // implements ShouldQueue {

    use Queueable, SerializesModels;

    private $data;
    
    public function __construct($data) {
        $this->data = $data;
    }

    public function envelope(): Envelope {

        return new Envelope(
            replyTo: [
                new Address('naoresponder@sigac.com', 'Sistema SIGAC'),
            ],
            to: [
                new Address($this->data->email, $this->data->coordenador),
            ],
            subject: 'SIGAC: Nova Solicitação de Horas Complementares',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'mail.hour-register',
            with: [
                'data' => $this->data,
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
