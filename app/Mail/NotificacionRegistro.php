<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionRegistro extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Bienvenido";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $datos_generales)
    {
        $this->request = $request;
        $this->datos_generales = $datos_generales;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $request = $this->request;
        $datos_generales = $this->datos_generales;
        return $this->view('emails.notificacion_registro', compact('request', 'datos_generales'));
    }
}
