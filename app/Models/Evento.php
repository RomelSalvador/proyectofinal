<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'fecha',
        'hora',
        'ubicacion',
        'aforo',
        'estado',
    ];


    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function recursos(){
    return $this->belongsToMany(Recurso::class, 'evento_recursos')
                ->withPivot('cantidad')
                ->withTimestamps();
    }

    
}
