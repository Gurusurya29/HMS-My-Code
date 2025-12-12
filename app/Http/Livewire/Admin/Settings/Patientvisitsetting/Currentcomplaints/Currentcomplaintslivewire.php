<?php

namespace App\Http\Livewire\Admin\Settings\Patientvisitsetting\Currentcomplaints;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Currentcomplaintslivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $currentcomplaint_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:currentcomplaints,name,' . $this->currentcomplaint_id,
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
            if ($this->currentcomplaint_id) {
                $currentcomplaint = Currentcomplaints::find($this->currentcomplaint_id);
                $currentcomplaint->update($validatedData);
                $user->currentcomplaintsupdatable()->save($currentcomplaint);
                Helper::trackmessage($user, $currentcomplaint, 'currentcomplaint_createoredit', session()->getId(), 'WEB', 'Current Complaints Master Setting Updated');
                $this->toaster('success', 'Current Complaints Master Setting Updated Successfully!!');
            } else {
                $currentcomplaint = $user->currentcomplaintscreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $currentcomplaint, 'currentcomplaint_createoredit', session()->getId(), 'WEB', 'Current Complaints Master Setting Created');
                $this->toaster('success', 'Current Complaints Master Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_currentcomplaints_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_currentcomplaints_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_currentcomplaints_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($currentcomplaintid, $type)
    {
        if ($type == 'edit') {
            $currentcomplaint = Currentcomplaints::find($currentcomplaintid);
            $this->name = $currentcomplaint->name;
            $this->note = $currentcomplaint->note;
            $this->active = $currentcomplaint->active;
            $this->currentcomplaint_id = $currentcomplaintid;
        } else {
            $this->showdata = Currentcomplaints::find($currentcomplaintid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->currentcomplaint_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $currentcomplaint = Currentcomplaints::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.patientvisitsetting.currentcomplaints.currentcomplaintslivewire',
            compact('currentcomplaint'));
    }
}
