<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontingen extends Model
{
    protected $guarded = [];

    public function atlets()
    {
        return $this->hasMany(Atlet::class, 'kontingens_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function kejuaraan()
    {
        return $this->belongsTo(Kejuaraan::class, 'kejuaraans_id', 'id');
    }
}
