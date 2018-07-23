<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
