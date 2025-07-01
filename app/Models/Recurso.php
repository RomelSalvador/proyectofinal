<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'descripcion',
        'tipo',
        'cantidad',
    ];

    public function eventos(){
    return $this->belongsToMany(Evento::class, 'evento_recursos')
                ->withPivot('cantidad')
                ->withTimestamps();
    }

}
