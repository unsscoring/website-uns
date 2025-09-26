<?php

namespace App\Livewire\Admin;

use App\Models\Kejuaraan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminKejuaraan extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraans = [], $isModalOpen;
    public function mount()
    {
        $this->kejuaraans = auth()->user()->kejuaraans;
    }
    public function render()
    {
        return view('livewire.admin.admin-kejuaraan')->layoutData(['adminKejuaraan' => 'active']);
    }
}
