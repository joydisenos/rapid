<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ciudads()
    {
        return $this->belongsTo(Ciudad::class,'ciudad');
    }
}
