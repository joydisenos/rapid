<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    public function restaurant()
    {
        return $this->belongsTo(User::class,'restaurant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
