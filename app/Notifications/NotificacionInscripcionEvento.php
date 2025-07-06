<?php

namespace App\Notifications;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NotificacionInscripcionEvento extends Notification
{
    use Queueable;

    protected $evento;

    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }
    
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'titulo' => 'Inscripción confirmada',
            'mensaje' => 'Te has inscrito correctamente en el evento "' . $this->evento->titulo . '"',
            'evento_id' => $this->evento->id,
            'fecha_evento' => $this->evento->fecha, 
        ];
    }
}
