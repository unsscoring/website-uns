<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kejuaraan extends Model
{
    protected $guarded = [];

    public function kontingens()
    {
        return $this->hasMany(Kontingen::class, 'kejuaraans_id', 'id');
    }
    public function kejuaraanUnduhans()
    {
        return $this->hasMany(KejuaraanUnduhan::class, 'kejuaraans_id', 'id');
    }
    public function kejuaraanBerkass()
    {
        return $this->hasMany(KejuaraanBerkas::class, 'kejuaraans_id', 'id');
    }
    public function kejuaraanKategoris()
    {
        return $this->hasMany(KejuaraanKategori::class, 'kejuaraans_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_kejuaraans', 'kejuaraan_id', 'user_id')
            ->withTimestamps(); // opsional
    }
}
