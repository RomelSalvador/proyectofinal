<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @mixin \Illuminate\Notifications\Notifiable
 * @method void notify(\Illuminate\Notifications\Notification $notification)
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'rol',
        'email',
        'password',
    ];

    /**
     * Atributos ocultos en las respuestas JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+ soporta esto
    ];

    /**
     * Relación con las inscripciones del usuario.
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
