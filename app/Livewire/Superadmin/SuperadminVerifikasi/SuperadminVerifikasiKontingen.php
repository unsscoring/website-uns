<?php

namespace App\Livewire\Superadmin\SuperadminVerifikasi;

use App\Models\Kejuaraan;
use App\Models\Kontingen;
use App\Models\RefStatus;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SuperadminVerifikasiKontingen extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan, $refStatusSelect = [];
    public $kontingen, $user, $name, $no_wa, $nama_kontingen, $alamat_kontingen, $nama_perguruan, $status;
    public function mount(Kontingen $kontingen)
    {
        $this->kejuaraan = $kontingen->kejuaraan;
        $this->user = auth()->user();
        $this->name = $kontingen?->nama_penanggung_jawab;
        $this->no_wa = $kontingen?->no_wa_penanggung_jawab;
        $this->nama_kontingen = $kontingen?->nama_kontingen;
        $this->alamat_kontingen = $kontingen?->alamat_kontingen;
        $this->status = $kontingen?->status;
        $this->refStatusSelect = RefStatus::get()->pluck('nama','id')->toArray();
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-verifikasi.superadmin-verifikasi-kontingen')->layoutData(['superadminVerifikasi' => 'active']);
    }
    public function updateKontingen()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'no_wa' => 'required|string|max:15',
                'nama_kontingen' => 'required|string|max:255',
                'alamat_kontingen' => 'required|string|max:255',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'name' => 'required|string|max:255',
                'no_wa' => 'required|string|max:15',
                'nama_kontingen' => 'required|string|max:255',
                'alamat_kontingen' => 'required|string|max:255',
            ]);
        }

        $this->kontingen->update([
            'nama_penanggung_jawab' => $this->name,
            'no_wa_penanggung_jawab' => $this->no_wa,
            'nama_kontingen' => $this->nama_kontingen,
            'alamat_kontingen' => $this->alamat_kontingen,
            'status' => $this->status,
        ]);

        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);
    }
}
