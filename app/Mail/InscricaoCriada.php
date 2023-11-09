<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Inscricao;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InscricaoCriada extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public Inscricao $inscricao,
        public String $image
    ) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('inscricao')
                    ->with(['inscricao' => $this->inscricao])
                    ->from('sieven.nes@ufms.com', 'SIEVEN UFMS')
                    ->subject($this->inscricao->nome);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Jeffrey Way'),
            subject: $this->inscricao->nome,
            // replyTo: [
            //     new Address('taylor@example.com', 'Taylor Otwell'),
            // ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'inscricao',
        );
    }
}
