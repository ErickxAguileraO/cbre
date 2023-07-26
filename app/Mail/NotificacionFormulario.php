<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionFormulario extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Notificación formulario";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos_generales, $user, $formulario)
    {
        $this->datos_generales = $datos_generales;
        $this->user = $user;
        $this->formulario = $formulario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $datos_generales = $this->datos_generales;
        $user = $this->user;
        $formulario = $this->formulario;
        return $this->view('emails.notificacion_formulario', compact('datos_generales', 'user', 'formulario'));
    }
}
