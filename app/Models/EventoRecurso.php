<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoRecurso extends Model
{
    use HasFactory;

    protected $table = 'evento_recursos';

    protected $fillable = [
        'evento_id',
        'recurso_id',
        'cantidad',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }
}
