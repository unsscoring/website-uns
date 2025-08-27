<?php

namespace App\Livewire\Guest;

use Livewire\Attributes\Layout;
use Livewire\Component;

class HomeController extends Component
{
    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.guest.home-controller');
    }
}
