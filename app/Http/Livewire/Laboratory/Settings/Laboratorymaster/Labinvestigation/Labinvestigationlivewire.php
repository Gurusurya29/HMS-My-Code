<?php

namespace App\Http\Livewire\Laboratory\Settings\Laboratorymaster\Labinvestigation;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigationgroup\Labinvestigationgroup;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
use App\Models\Laboratory\Settings\Laboratorymaster\Labtestmethod\Labtestmethod;
use App\Models\Laboratory\Settings\Laboratorymaster\Labunit\Labunit;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labinvestigationlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $labinvestigationgroup_id, $selffee, $insurancefee, $note, $range, $active = false;

    public $labinvestigation_id, $labtestmethod_id, $labunit_id;
    public $showdata;
    public $labinvestigationgrouplist, $labtestmethodlist, $labunitslist;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:labinvestigations,name,' . $this->labinvestigation_id,
            'labinvestigationgroup_id' => 'required|numeric',
            'labtestmethod_id' => 'nullable|numeric',
            'labunit_id' => 'nullable|numeric',
            'insurancefee' => 'required|numeric|integer',
            'selffee' => 'required|numeric|integer',
            'range' => 'nullable|max:255',
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    protected function messages()
    {
        return [
            'labinvestigationgroup_id.required' => 'Select investigationgroup.',
            'insurancefee.integer' => 'Enter valid value.',
            'selffee.integer' => 'Enter valid value.',
        ];
    }

    public function mount()
    {
        $this->labinvestigationgrouplist = Labinvestigationgroup::where('active', true)->pluck('name', 'id')->toArray();
        $this->labtestmethodlist = Labtestmethod::where('active', true)->pluck('name', 'id')->toArray();
        $this->labunitslist = Labunit::where('active', true)->pluck('name', 'id')->toArray();
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['labtestmethod_id'] = $this->labtestmethod_id ? $this->labtestmethod_id : null;
        $validatedData['labunit_id'] = $this->labunit_id ? $this->labunit_id : null;
        $user = $this->currentuser();

        try {
            DB::beginTransaction();
            if ($this->labinvestigation_id) {
                $labinvestigation = Labinvestigation::find($this->labinvestigation_id);
                $labinvestigation->update($validatedData);
                $user->labinvestigationupdatable()->save($labinvestigation);
                Helper::trackmessage($user, $labinvestigation, 'labinvestigation_createoredit', session()->getId(), 'WEB', 'Investigation Name Updated');
                $this->toaster('success', 'Investigation Name Updated Successfully!!');
            } else {
                $labinvestigation = $user->labinvestigationcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $labinvestigation, 'labinvestigation_createoredit', session()->getId(), 'WEB', 'Investigation Name Created');
                $this->toaster('success', 'Investigation Name Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'laboratory_labinvestigation_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'laboratory_labinvestigation_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'laboratory_labinvestigation_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($labinvestigationid, $type)
    {
        if ($type == 'edit') {
            $labinvestigation = Labinvestigation::find($labinvestigationid);
            $this->name = $labinvestigation->name;
            $this->labinvestigationgroup_id = $labinvestigation->labinvestigationgroup_id;
            $this->selffee = $labinvestigation->selffee;

            $this->labtestmethod_id = $labinvestigation->labtestmethod_id;
            $this->labunit_id = $labinvestigation->labunit_id;

            $this->insurancefee = $labinvestigation->insurancefee;
            $this->range = $labinvestigation->range;
            $this->note = $labinvestigation->note;
            $this->active = $labinvestigation->active;
            $this->labinvestigation_id = $labinvestigationid;
        } else {
            $this->showdata = Labinvestigation::find($labinvestigationid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->labinvestigation_id = $this->selffee = $this->insurancefee =
        $this->labinvestigationgroup_id = $this->labtestmethod_id = $this->labunit_id = $this->range = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $labinvestigation = Labinvestigation::query()
            ->where(fn($q) =>
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('labinvestigationgroup', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.laboratory.settings.laboratorymaster.labinvestigation.labinvestigationlivewire',
            compact('labinvestigation'));
    }
}
