<?php

namespace App\Http\Livewire\Admin\Settings\Tracking;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Settings\Tracking\Tracking;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Trackinglivewire extends Component
{
    use datatableLivewireTrait;

    public function render()
    {
        $tracking = Tracking::query()
            ->where(fn($q) =>
                $q->where('trackmsg', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('trackable', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('usertype', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.settings.tracking.trackinglivewire', compact('tracking'));

    }
}
