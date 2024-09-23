<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Story extends Component
{
    public $ceritabaru = false;
    public function buatCeritaBaru(){
        $this->ceritabaru = true;
    }

    public function batal(){
        $this->reset();
    }

    public function render()
    {
        $semuamemberkecualisaya = User::all()->except(auth()->user()->id);
        return view('livewire.story')->with([
            'semuamemberkecualisaya' => $semuamemberkecualisaya
        ]);
    }
}
