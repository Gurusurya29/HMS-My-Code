<?php

namespace App\Http\Livewire\Admin\Wardmanagement;

use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardfloor;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use Livewire\Component;

class Wardfloormanagementlivewire extends Component
{

    public $wardfloor, $wardtype, $bedorroom;

    public function mount()
    {
        $this->wardtype = Wardtype::where('active', true)->get();
        $this->wardfloor = Wardfloor::where('active', true)->get();
        $this->bedorroom = Bedorroomnumber::where('active', true)->get();
        // dd($this->bedorroom);
    }

    public function render()
    {
        return view('livewire.admin.wardmanagement.wardfloormanagementlivewire');
    }
}
