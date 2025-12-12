<?php

namespace App\Http\Livewire\Pharmacy\Settings\Drugmaster\Pharmacygenaric;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Drugmaster\Genaric\Pharmacygenaric;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pharmacygenariclivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $active = false, $note;

    public $pharmacygenaric_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:pharmacygenarics,name,' . $this->pharmacygenaric_id,
            'active' => 'nullable|boolean',
            'note' => 'nullable|max:255',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            if ($this->pharmacygenaric_id) {
                $pharmacygenaric = Pharmacygenaric::find($this->pharmacygenaric_id);
                $pharmacygenaric->update($validatedData);
                $this->currentuser()->pharmacygenaricupdatable()->save($pharmacygenaric);

                Helper::trackmessage($this->currentuser(), $pharmacygenaric, 'pharmacygenaric_createoredit', session()->getId(), 'WEB', 'Genaric Name Updated');
                $this->toaster('success', 'Genaric Name Updated Successfully!!');
            } else {
                $pharmacygenaric = $this->currentuser()->pharmacygenariccreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $pharmacygenaric, 'pharmacygenaric_createoredit', session()->getId(), 'WEB', 'Genaric Name Created');
                $this->toaster('success', 'Genaric Name Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacygenarics_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacygenarics_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacygenarics_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($pharmacygenaricid, $type)
    {
        if ($type == 'edit') {
            $pharmacygenaric = Pharmacygenaric::find($pharmacygenaricid);
            $this->name = $pharmacygenaric->name;
            $this->note = $pharmacygenaric->note;
            $this->pharmacygenaric_id = $pharmacygenaricid;
            $this->active = $pharmacygenaric->active;
        } else {
            $this->showdata = Pharmacygenaric::find($pharmacygenaricid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->pharmacygenaric_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $pharmacygenaric = Pharmacygenaric::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.settings.drugmaster.pharmacygenaric.pharmacygenariclivewire',
            compact('pharmacygenaric'));
    }
}
