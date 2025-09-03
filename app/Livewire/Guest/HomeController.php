<?php

namespace App\Livewire\Guest;

use App\Models\Kejuaraan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomeController extends Component
{
    #[Layout('layouts.guest')]
    public $kejuaraans;
    public function mount()
    {
        $this->kejuaraans = Kejuaraan::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.guest.home-controller');
    }
}
