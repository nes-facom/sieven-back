<?php

namespace App\Mail;

use App\Models\Atividade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newLaravelTips extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\stdClass $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $atividades = Atividade::all();

        $this->subject('Novo episódio no ar!');
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('mails.newLaravelTips', [
            'user' => $this->user,
            'atividades' => $atividades,
        ]);
    }
}
