<?php

namespace App\Livewire\Superadmin\SuperadminVerifikasi;

use App\Models\Kejuaraan;
use App\Models\Kontingen;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SuperadminVerifikasiKejuaraan extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan, $kontingens;
    public function mount(Kejuaraan $kejuaraan)
    {
        $this->kejuaraan = $kejuaraan;
        $this->kontingens = Kontingen::where('kejuaraans_id', $kejuaraan->id)
            ->withCount(['atlets as jumlah_atlet'])
            ->withCount(['atlets as jumlah_terverifikasi' => function ($query) {
                $query->whereHas('refStatus', function ($q) {
                    $q->where('nama', 'terverifikasi');
                });
            }])
            ->get();
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-verifikasi.superadmin-verifikasi-kejuaraan');
    }
}
