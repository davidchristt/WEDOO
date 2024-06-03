<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mobil;

class Mobils extends Component
{
    public $mobils;

    public function mount()
    {
        $this->mobils = Mobil::all();
    }

    public function render()
    {
        return view('livewire.mobils', ['mobils' => $this->mobils]);
    }
}

