<?php

namespace App\Http\Livewire\Pharmacy\Common\Selectpharmacy;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Pharmacy\Settings\Branch\Pharmbranch;
use Livewire\Component;

class Selectpharmacylivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $selectid;

    protected $rules = [
        'selectid' => 'required|integer',
    ];

    public function mount()
    {
        $user = $this->currentuser();
        if ($user->pharmbranch_id) {
            $this->selectid = $user->pharmbranch_id;
        } else {
            $user->pharmbranch_id = 1;
            $user->save();
            $this->selectid = 1;
        }
    }

    public function handlechange()
    {
        $pharmbranch = Pharmbranch::find($this->selectid);
        if ($pharmbranch) {
            $user = $this->currentuser();
            $user->pharmbranch_id = $this->selectid;
            $user->save();
        }
    }

    public function render()
    {
        $pharmacybranch = Pharmbranch::get();

        return view('livewire.pharmacy.common.selectpharmacy.selectpharmacylivewire', compact('pharmacybranch'));
    }
}
