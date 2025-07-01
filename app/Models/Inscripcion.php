<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripcions'; 

    protected $fillable = [
        'user_id',
        'evento_id',
        'fecha',
        'estado',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
