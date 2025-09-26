<?php

namespace App\Livewire\Admin\AdminVerifikasi;

use App\Exports\ExportAtlet;
use App\Exports\ExportKontingen;
use App\Models\Kejuaraan;
use App\Models\Kontingen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class AdminVerifikasiKejuaraan extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan, $kontingens;
    public function mount(Kejuaraan $kejuaraan)
    {
        if (!Auth::user()->kejuaraans->contains($kejuaraan->id)) {
            abort(404);
        }
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
        return view('livewire.admin.admin-verifikasi.admin-verifikasi-kejuaraan')->layoutData(['adminVerifikasi' => 'active']);
    }

    public function exportKontingen()
    {
        return Excel::download(new ExportKontingen($this->kejuaraan->id), 'Rekap Kontingen_' . $this->kejuaraan->nama_kejuaraan . '_' . Carbon::now()->toDateString() . '.xlsx');
    }

    public function exportAtlet()
    {
        return Excel::download(new ExportAtlet($this->kejuaraan->id), 'Rekap Atlet_' . $this->kejuaraan->nama_kejuaraan . '_' . Carbon::now()->toDateString() . '.xlsx');
    }
}
