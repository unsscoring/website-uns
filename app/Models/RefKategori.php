<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefKategori extends Model
{
    protected $guarded = [];

    public function refGolongan()
    {
        return $this->belongsTo(RefGolongan::class, 'golongans_id', 'id');
    }

    public function refRegulasi()
    {
        return $this->belongsTo(RefRegulasi::class, 'regulasis_id', 'id');
    }

    public function kejuaraanKategori()
    {
        return $this->hasMany(KejuaraanKategori::class,'ref_kategoris_id', 'id');
    }

    public function atlets()
    {
        return $this->hasMany(Atlet::class, 'ref_kategoris_id', 'id');
    }
}
