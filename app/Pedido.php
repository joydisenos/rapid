<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(User::class,'restaurant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
