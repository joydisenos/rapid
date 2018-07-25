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
        'tipo','name', 'apellido', 'localidad' , 'telefono', 'nombre_del_restaurante', 'descripcion', 'logo', 'slug', 'categorias', 'direccion', 'ciudad', 'email', 'password',
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

    public function ciudad()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function ventas()
    {
        return $this->hasMany(Pedido::class,'restaurant_id');
    }    

}
