<?php

namespace App\Http\Livewire\Admin\Settings\Patientregisterationsetting\States;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stateslivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $code, $note, $active = false;
    public $countryoption;
    public $country_id, $stateid;
    public $showdata;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->sortColumnName = 'id';
        $this->sortDirection = "asc";
        $this->countryoption = Country::where('active', true)->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:states,name,' . $this->stateid,
            'code' => 'required|min:2|max:5',
            'country_id' => 'required',
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->stateid) {
                $state = State::find($this->stateid);
                $state->update($validatedData);
                $user->stateupdatable()->save($state);
                Helper::trackmessage($user, $state, 'state_createoredit', session()->getId(), 'WEB', 'State Setting Updated');
                $this->toaster('success', 'State Setting Updated Successfully!!');
            } else {
                $state = $user->statecreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $state, 'state_createoredit', session()->getId(), 'WEB', 'State Setting Created');
                $this->toaster('success', 'State Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_state_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_state_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_state_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($state_id, $type)
    {
        if ($type == 'edit') {
            $state = State::find($state_id);
            $this->country_id = $state->country_id;
            $this->name = $state->name;
            $this->code = $state->code;
            $this->active = $state->active;
            $this->note = $state->note;
            $this->stateid = $state_id;
        } else {
            $this->showdata = State::find($state_id);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->stateid = $this->code = $this->country_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $state = State::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.patientregisterationsetting.states.stateslivewire', compact('state'));
    }
}
