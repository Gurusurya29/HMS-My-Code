<?php

namespace App\Http\Livewire\Pharmacy\Common;

use App\Models\Admin\Prescription\Prescription;
use Carbon\Carbon;
use Livewire\Component;

class Hsmalertlivewire extends Component
{
    public function render()
    {
        $emghms = Prescription::where('is_emergency', true)
            ->where('ispharm_proccessed', false)
            ->whereBetween('created_at', [Carbon::now()->subHours(12), Carbon::now()])
            ->get();
        return view('livewire.pharmacy.common.hsmalertlivewire', compact('emghms'));
    }
}
