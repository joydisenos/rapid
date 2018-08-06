<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoriarest extends Model
{
    public function restaurant()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
