<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public function users()
    {
        return $this->hasMany(User::class,'ciudad');
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class,'ciudad');
    }
}
