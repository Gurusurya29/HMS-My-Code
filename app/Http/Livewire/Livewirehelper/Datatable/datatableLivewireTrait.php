<?php

namespace App\Http\Livewire\Livewirehelper\Datatable;

use Livewire\WithPagination;

trait datatableLivewireTrait
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $paginationlength = 10;

    public function create()
    {
        $this->formreset();
    }

    public function edit($editid)
    {
        $this->formreset();
        $this->databind($editid, 'edit');
        $this->dispatch('editmodal');
    }

    public function show($showid)
    {
        $this->databind($showid, 'show');
        $this->dispatch('showmodal');
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortColumnName === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumnName = $field;

    }

}
