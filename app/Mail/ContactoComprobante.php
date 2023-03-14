<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoComprobante extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Confirmación de recepción de formulario";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $datos_generales)
    {
        $this->datos_generales = $datos_generales;
        $this->request = $request;
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
        return $this->view('emails.contacto_comprobante', compact('request', 'datos_generales'));
    }
}
