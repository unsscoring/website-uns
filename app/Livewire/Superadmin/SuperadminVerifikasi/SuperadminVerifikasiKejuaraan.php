<?php

namespace App\Livewire\Superadmin\SuperadminVerifikasi;

use App\Exports\ExportAtlet;
use App\Exports\ExportKontingen;
use App\Models\Kejuaraan;
use App\Models\Kontingen;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SuperadminVerifikasiKejuaraan extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan, $kontingens, $kontingenId;
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
        return view('livewire.superadmin.superadmin-verifikasi.superadmin-verifikasi-kejuaraan')->layoutData(['superadminVerifikasi' => 'active']);
    }

    public function exportKontingen()
    {
        return Excel::download(new ExportKontingen($this->kejuaraan->id), 'Rekap Kontingen_' . $this->kejuaraan->nama_kejuaraan . '_' . Carbon::now()->toDateString() . '.xlsx');
    }

    public function exportAtlet()
    {
        return Excel::download(new ExportAtlet($this->kejuaraan->id), 'Rekap Atlet_' . $this->kejuaraan->nama_kejuaraan . '_' . Carbon::now()->toDateString() . '.xlsx');
    }

    public function confirmDeleteKontingen($id)
    {
        $this->kontingenId = $id;
        $kontingen = Kontingen::find($id);

        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus ' . $kontingen->nama,
            'icon' => 'warning',
            'dispatchOn' => 'deletekontingen',
        ]);
    }

    #[On('deletekontingen')]
    public function deletekontingen()
    {
        $kontingen = Kontingen::find($this->kontingenId);
        $nama = $kontingen->nama;
        $kontingen->delete();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menghapus ' . $nama,
            'icon' => 'success'
        ]);
        $this->kontingenId = null;
        $this->kontingens = Kontingen::where('kejuaraans_id', $this->kejuaraan->id)
            ->withCount(['atlets as jumlah_atlet'])
            ->withCount(['atlets as jumlah_terverifikasi' => function ($query) {
                $query->whereHas('refStatus', function ($q) {
                    $q->where('nama', 'terverifikasi');
                });
            }])
            ->get();
    }
}
