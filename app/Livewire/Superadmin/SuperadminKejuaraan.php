<?php

namespace App\Livewire\Superadmin;

use App\Models\Kejuaraan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SuperadminKejuaraan extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraans = [], $isModalOpen, $kejuaraanId;
    public function mount()
    {
        $this->kejuaraans = Kejuaraan::latest()->get();
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-kejuaraan')->layoutData(['superadminKejuaraan' => 'active']);
    }

    public function confirmDeleteKejuaraan($id)
    {
        $this->kejuaraanId = $id;
        $kejuaraan = Kejuaraan::find($id);

        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus ' . $kejuaraan->nama_kejuaraan,
            'icon' => 'warning',
            'dispatchOn' => 'deleteKejuaraan'
        ]);
    }

    #[On('deleteKejuaraan')]
    public function deleteKejuaraan()
    {
        $kejuaraan = Kejuaraan::find($this->kejuaraanId);
        $nama = $kejuaraan->nama_kejuaraan;
        $kejuaraan->delete();

        $this->kejuaraans = Kejuaraan::latest()->get();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menghapus ' . $nama,
            'icon' => 'success'
        ]);
    }
}
