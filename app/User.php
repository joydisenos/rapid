<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo','name', 'apellido', 'localidad' , 'telefono', 'nombre_del_restaurante', 'descripcion', 'logo', 'slug', 'categorias', 'direccion', 'ciudad', 'email', 'password','expira',
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

    public function ciudads()
    {
        return $this->belongsTo(Ciudad::class,'ciudad');
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

    public function configuracion()
    {
        return $this->hasOne(Config::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    public function marcado()
    {
        return $this->hasMany(Favorito::class , 'restaurant_id');
    }

    public function categorias()
    {
        return $this->hasMany(Categoriarest::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class,'restaurant_id');
    }

}
