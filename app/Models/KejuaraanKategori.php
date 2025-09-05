<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KejuaraanKategori extends Model
{
    protected $guarded = [];

    public function refKategori()
    {
        return $this->hasOne(RefKategori::class, 'id', 'ref_kategoris_id');
    }
    public function kejuaraan()
    {
        return $this->belongsTo(Kejuaraan::class, 'kejuaraans_id');
    }
}
