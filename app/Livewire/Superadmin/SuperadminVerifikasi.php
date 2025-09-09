<?php

namespace App\Livewire\Superadmin;

use App\Models\Kejuaraan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SuperadminVerifikasi extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraans = [], $isModalOpen;
    public function mount()
    {
        $this->kejuaraans = Kejuaraan::latest()->get();
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-verifikasi')->layoutData(['superadminVerifikasi' => 'active']);
    }
}
