<?php

namespace App\Livewire\Superadmin;

use App\Models\Atlet;
use App\Models\Kejuaraan;
use App\Models\Kontingen;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SuperadminDashboard extends Component
{
    public $jumlahKejuaraan, $jumlahUser, $jumlahKontingen, $jumlahAtlet;

    #[Layout('layouts.admin')]
    public function mount()
    {
        $this->jumlahKejuaraan = Kejuaraan::count();
        $this->jumlahUser = User::count();
        $this->jumlahKontingen = Kontingen::count();
        $this->jumlahAtlet = Atlet::count();
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-dashboard')->layoutData(['superadminDashboard' => 'active']);
    }
}
