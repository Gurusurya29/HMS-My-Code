<?php

namespace App\Http\Livewire\Laboratory\Settings\Laboratorymaster\Labtestmethod;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Laboratory\Settings\Laboratorymaster\Labtestmethod\Labtestmethod;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labtestmethodlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $labtestmethod_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:labtestmethods,name,' . $this->labtestmethod_id,
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = $this->currentuser();

        try {
            DB::beginTransaction();
            if ($this->labtestmethod_id) {
                $labtestmethod = Labtestmethod::find($this->labtestmethod_id);
                $labtestmethod->update($validatedData);
                $user->labtestmethodupdatable()->save($labtestmethod);
                Helper::trackmessage($user, $labtestmethod, 'labtestmethod_createoredit', session()->getId(), 'WEB', 'Unit Updated');
                $this->toaster('success', 'Unit Updated Successfully!!');
            } else {
                $labtestmethod = $user->labtestmethodcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $labtestmethod, 'labtestmethod_createoredit', session()->getId(), 'WEB', 'Unit Created');
                $this->toaster('success', 'Unit Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'laboratory_labtestmethod_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'laboratory_labtestmethod_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'laboratory_labtestmethod_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($labtestmethodid, $type)
    {
        if ($type == 'edit') {
            $labtestmethod = Labtestmethod::find($labtestmethodid);
            $this->name = $labtestmethod->name;
            $this->note = $labtestmethod->note;
            $this->active = $labtestmethod->active;
            $this->labtestmethod_id = $labtestmethodid;
        } else {
            $this->showdata = Labtestmethod::find($labtestmethodid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->labtestmethod_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $labtestmethod = Labtestmethod::query()
            ->where(fn($q) =>
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.laboratory.settings.laboratorymaster.labtestmethod.labtestmethodlivewire',
            compact('labtestmethod'));
    }
}
