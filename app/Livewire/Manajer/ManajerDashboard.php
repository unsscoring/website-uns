<?php

namespace App\Livewire\Manajer;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ManajerDashboard extends Component
{
    public $user, $kontingens, $jumlahAtlet;

    #[Layout('layouts.admin')]
    public function mount()
    {
        $this->user = auth()->user();
        $this->kontingens = $this->user->kontingens()->with('atlets')->get();
        $this->jumlahAtlet = $this->kontingens->sum(function ($k) {
            return $k->atlets ? $k->atlets->count() : 0;
        });
    }
    public function render()
    {
        return view('livewire.manajer.manajer-dashboard')->layoutData(['manajerDashboard' => 'active']);
    }
}
