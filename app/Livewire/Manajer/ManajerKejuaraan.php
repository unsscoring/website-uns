<?php

namespace App\Livewire\Manajer;

use App\Models\Kejuaraan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManajerKejuaraan extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraans;
    public function mount()
    {
        $this->kejuaraans = Kejuaraan::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.manajer.manajer-kejuaraan')->layoutData(['manajerKejuaraan' => 'active']);
    }
}
