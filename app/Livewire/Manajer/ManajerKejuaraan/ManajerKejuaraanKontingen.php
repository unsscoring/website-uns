<?php

namespace App\Livewire\Manajer\ManajerKejuaraan;

use App\Models\Kejuaraan;
use App\Models\Kontingen;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManajerKejuaraanKontingen extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan;
    public $kontingen, $user, $name, $no_wa, $nama_kontingen, $alamat_kontingen, $nama_perguruan;
    public function mount(Kejuaraan $kejuaraan)
    {
        $this->kejuaraan = $kejuaraan;
        $this->user = auth()->user();
        $kontingen = Kontingen::where('users_id', $this->user->id)
            ->where('kejuaraans_id', $kejuaraan->id)
            ->first();
        $this->kontingen = $kontingen;
        $this->name = $kontingen?->nama_penanggung_jawab;
        $this->no_wa = $kontingen?->no_wa_penanggung_jawab;
        $this->nama_kontingen = $kontingen?->nama_kontingen;
        $this->alamat_kontingen = $kontingen?->alamat_kontingen;
    }
    public function render()
    {
        return view('livewire.manajer.manajer-kejuaraan.manajer-kejuaraan-kontingen')->layoutData(['manajerKejuaraan' => 'active']);
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

        if ($this->kontingen) {
            $this->kontingen->update([
                'nama_penanggung_jawab' => $this->name,
                'no_wa_penanggung_jawab' => $this->no_wa,
                'nama_kontingen' => $this->nama_kontingen,
                'alamat_kontingen' => $this->alamat_kontingen,
            ]);
        }
        else {
            Kontingen::create([
                'users_id' => $this->user->id,
                'kejuaraans_id' => $this->kejuaraan->id,
                'nama_penanggung_jawab' => $this->name,
                'nama_wa_penanggung_jawab' => $this->no_wa,
                'nama_kontingen' => $this->nama_kontingen,
                'alamat_kontingen' => $this->alamat_kontingen,
                'status' => 1, // Status: Pending
            ]);
        }

        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
            'redirect' => '/manajer/kejuaraan/' . $this->kejuaraan->id . '/atlet',
        ]);
    }
}
