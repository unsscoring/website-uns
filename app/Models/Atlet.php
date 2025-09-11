<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atlet extends Model
{
    protected $guarded = [];
    
    public function refKategori()
    {
        return $this->hasOne(RefKategori::class, 'id', 'ref_kategoris_id');
    }

    public function refStatus()
    {
        return $this->hasOne(RefStatus::class, 'id', 'status');
    }

    public function kontingen()
    {
        return $this->belongsTo(Kontingen::class, 'kontingens_id', 'id');
    }
}
