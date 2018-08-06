<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(User::class,'restaurant_id');
    }
}
