<?php

namespace App\Http\Livewire\Admin\Operationtheatre\Othistory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Othistorylivewire extends Component
{
    use datatableLivewireTrait;

    public $showdata;
    public $from_date;
    public $to_date;

    public function mount()
    {
        $this->from_date = null;
        $this->to_date = null;
    }

    protected function databind($otscheduleid, $type)
    {
        $this->showdata = Otschedule::find($otscheduleid);
    }

    public function downloadFile($otscheduleuniqid, $file_name)
    {
        $file = storage_path('app/public/admin/otschedule/' . $otscheduleuniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function render()
    {
        $from_date = $this->from_date;
        $to_date = $this->to_date;
        $othistory = Otschedule::with('patient')
        // ->where('active', true)
        //->whereNotNull('is_movetoip')
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('surgery_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->when($from_date, function ($query, $from_date) {
                $query->whereDate('surgery_startdate', '>=', $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                $query->whereDate('surgery_startdate', '<=', $to_date);
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.operationtheatre.othistory.othistorylivewire',
            compact('othistory'));
    }
}
