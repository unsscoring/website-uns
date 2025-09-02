<?php

namespace App\Livewire\Manajer;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ManajerDashboard extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.manajer.manajer-dashboard')->layoutData(['manajerDashboard' => 'active']);
    }
}
