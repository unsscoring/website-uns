<?php

namespace App\Livewire\Superadmin;

use App\Models\Kejuaraan;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;

class SuperadminKejuaraanCreate extends Component
{
    #[Layout('layouts.admin')]
    public $nama_kejuaraan, $slug, $penyelenggara, $mode_kejuaraan, $link_kejuaraan, $swo, $deskripsi;
    public $isSubmitting = false;
    public function render()
    {
        return view('livewire.superadmin.superadmin-kejuaraan-create')->layoutData(['superadminKejuaraan' => 'active']);
    }
    public function ubahNamaKejuaraan()
    {
        $this->slug = Str::slug($this->nama_kejuaraan);
    }

    public function createKejuaraan()
    {
        if ($this->isSubmitting) {
            return;
        }
        try {
            $this->isSubmitting = true;
            $this->validate([
                'nama_kejuaraan' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:kejuaraans,slug',
                'penyelenggara' => 'required|string|max:255',
                'mode_kejuaraan' => 'required|string|max:50',
                'link_pendaftaran' => 'nullable|url|max:255',
                'swo' => 'required|integer|min:0',
                'deskripsi' => 'nullable|string',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'nama_kejuaraan' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:kejuaraans,slug',
                'penyelenggara' => 'required|string|max:255',
                'mode_kejuaraan' => 'required|string|max:50',
                'link_kejuaraan' => 'nullable|url|max:255',
                'swo' => 'required|integer|min:0',
                'deskripsi' => 'nullable|string',
            ]);
        }

        $kejuaraan = Kejuaraan::create([
            'nama_kejuaraan' => $this->nama_kejuaraan,
            'slug' => $this->slug,
            'penyelenggara' => $this->penyelenggara,
            'link_kejuaraan' => $this->link_kejuaraan,
            'swo' => $this->swo,
            'deskripsi' => $this->deskripsi ?? "",
        ]);
        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
            'redirect' => '/superadmin/kejuaraan-update/' . $kejuaraan->id.'/informasi',
        ]);
    }
}
