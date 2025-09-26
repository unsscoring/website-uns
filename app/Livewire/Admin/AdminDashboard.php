<?php

namespace App\Livewire\Admin;

use App\Models\Atlet;
use App\Models\Kejuaraan;
use App\Models\Kontingen;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $jumlahKejuaraan;

    #[Layout('layouts.admin')]
    public function mount()
    {
        $this->jumlahKejuaraan = auth()->user()->kejuaraans->count();
    }
    public function render()
    {
        return view('livewire.admin.admin-dashboard')->layoutData(['adminDashboard' => 'active']);
    }
}
