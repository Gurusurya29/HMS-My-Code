<?php

namespace App\Http\Livewire\Laboratory\Settings\Laboratorymaster\Labinvestigationgroup;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigationgroup\Labinvestigationgroup;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labinvestigationgrouplivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $labinvestigationtype, $note, $active = false;

    public $labinvestigationgroup_id;
    public $showdata;
    public $investigationtype;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:labinvestigationgroups,name,' . $this->labinvestigationgroup_id,
            'labinvestigationtype' => 'required',
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
            if ($this->labinvestigationgroup_id) {
                $labinvestigationgroup = Labinvestigationgroup::find($this->labinvestigationgroup_id);
                $labinvestigationgroup->update($validatedData);
                $user->laboratoryupdatable()->save($labinvestigationgroup);
                Helper::trackmessage($user, $labinvestigationgroup, 'labinvestigationgroup_createoredit', session()->getId(), 'WEB', 'investigationgroup Updated');
                $this->toaster('success', 'investigationgroup Updated Successfully!!');
            } else {
                $labinvestigationgroup = $user->labinvestigationgroupcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $labinvestigationgroup, 'labinvestigationgroup_createoredit', session()->getId(), 'WEB', 'investigationgroup Created');
                $this->toaster('success', 'investigationgroup Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'laboratory_labinvestigationgroup_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'laboratory_labinvestigationgroup_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'laboratory_labinvestigationgroup_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($labinvestigationgroupid, $type)
    {
        if ($type == 'edit') {
            $labinvestigationgroup = Labinvestigationgroup::find($labinvestigationgroupid);
            $this->name = $labinvestigationgroup->name;
            $this->labinvestigationtype = $labinvestigationgroup->labinvestigationtype;
            $this->note = $labinvestigationgroup->note;
            $this->active = $labinvestigationgroup->active;
            $this->labinvestigationgroup_id = $labinvestigationgroupid;
        } else {
            $this->showdata = Labinvestigationgroup::find($labinvestigationgroupid);
        }
    }

    public function formreset()
    {
        $this->name = $this->labinvestigationtype = $this->note = $this->labinvestigationgroup_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function clear()
    {
        $this->investigationtype = null;
        $this->searchTerm = null;
        $this->resetPage();
    }

    public function render()
    {
        $investigationtype = $this->investigationtype;
        $labinvestigationgroup = Labinvestigationgroup::query()
            ->where(fn($q) =>
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
            )
            ->when($investigationtype, function ($query, $investigationtype) {
                $query->where('labinvestigationtype', $investigationtype);
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.laboratory.settings.laboratorymaster.labinvestigationgroup.labinvestigationgrouplivewire',
            compact('labinvestigationgroup'));
    }
}
