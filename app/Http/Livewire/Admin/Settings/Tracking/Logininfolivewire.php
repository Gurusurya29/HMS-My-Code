<?php

namespace App\Http\Livewire\Admin\Settings\Tracking;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Settings\Tracking\Logininfo;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Logininfolivewire extends Component
{
    use datatableLivewireTrait;

    public function render()
    {
        $logininfo = Logininfo::query()
            ->where(fn($q) =>
                $q->where('device', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('browser', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('platform', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('type', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('logininfoable', fn(Builder $q) =>
                        $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('usertype', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.settings.tracking.logininfolivewire', compact('logininfo'));
    }
}
