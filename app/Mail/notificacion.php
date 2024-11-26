<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class notificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;   // Declaramos la variable para el usuario
    public $nuevaclave; // Declaramos la variable para la nueva clave
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario, $nuevaclave)
    {
        // Asignamos las variables que se reciben al instanciar el Mailable
        $this->usuario = $usuario;
        $this->nuevaclave = $nuevaclave;

        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Recuperar Contraseña',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'login.recupera',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
