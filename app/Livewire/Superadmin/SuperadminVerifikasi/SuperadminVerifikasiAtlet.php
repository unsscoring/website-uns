<?php

namespace App\Livewire\Superadmin\SuperadminVerifikasi;

use App\Models\Kejuaraan;
use App\Models\Kontingen;
use App\Models\RefGolongan;
use App\Models\RefKategori;
use App\Models\RefStatus;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SuperadminVerifikasiAtlet extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan, $user, $atletId, $atlets, $kontingen;
    public $isModalOpen = false;
    public $nama_atlet, $tempat_lahir, $tanggal_lahir, $nik, $gender, $golongan, $kategori, $status, $isSubmitting = false, $modalStatus, $atlet;
    public $golonganSelect = [];
    public $jenisSelect = [];
    public $cabangSelect = [];
    public $kategoriSelect = [];
    public $statusSelect = [];
    public function mount(Kontingen $kontingen)
    {
        $this->kontingen = $kontingen;
        $this->kejuaraan = $kontingen->kejuaraan;
        $this->atlets = $this->kontingen->atlets;
        $this->golonganSelect = RefGolongan::pluck('nama', 'id')->toArray();
        $this->statusSelect = RefStatus::pluck('nama', 'id')->toArray();
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-verifikasi.superadmin-verifikasi-atlet')->layoutData(['superadminVerifikasi' => 'active']);
    }
}
