<?php

namespace App\Http\Livewire\Admin\Wardmanagement;

use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use Livewire\Component;

class Wardavailabilitylivewire extends Component
{
    public $wardtype, $bedorroom;

    public function mount()
    {
        $this->wardtype = Wardtype::where('active', true)->get();
        $this->bedorroom = Bedorroomnumber::where('active', true)->get();
    }

    public function render()
    {
        return view('livewire.admin.wardmanagement.wardavailabilitylivewire');
    }
}
