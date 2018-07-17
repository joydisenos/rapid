<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo','name', 'apellido', 'telefono', 'nombre_del_restaurante', 'descripcion', 'logo', 'slug', 'categorias', 'direccion', 'ciudad', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }
}
