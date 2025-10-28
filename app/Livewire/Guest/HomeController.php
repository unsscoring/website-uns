<?php

namespace App\Livewire\Guest;

use App\Models\Kejuaraan;
use App\Models\Kontingen;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomeController extends Component
{
    #[Layout('layouts.guest')]
    public $kejuaraans;
    public $userCount, $eventCount, $kontingenCount;
    public function mount()
    {
        $this->kejuaraans = Kejuaraan::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $this->userCount = User::count();
        $this->eventCount = $this->kejuaraans->count();
        $this->kontingenCount = Kontingen::count();
    }

    public function render()
    {
        return view('livewire.guest.home-controller');
    }
}
