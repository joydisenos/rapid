<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
