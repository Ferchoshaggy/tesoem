<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionesCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $subject;
    public $modulo;
    public $ruta;
    public function __construct($titulo,$mensaje,$modulo,$ruta)
    {
        $this->datos = $mensaje;
        $this->subject = $titulo;
        $this->modulo = $modulo;
        $this->ruta = $ruta;
    }

    public function build()
    {

        return $this->view('Correos.notificacion_plantilla');
        
    }
}
