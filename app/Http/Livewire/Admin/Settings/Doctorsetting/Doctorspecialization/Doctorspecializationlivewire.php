<?php

namespace App\Http\Livewire\Admin\Settings\Doctorsetting\Doctorspecialization;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Doctorspecializationlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $doctorspecialization_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:doctorspecializations,name,' . $this->doctorspecialization_id,
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
            if ($this->doctorspecialization_id) {
                $doctorspecialization = Doctorspecialization::find($this->doctorspecialization_id);
                $doctorspecialization->update($validatedData);
                $user->doctorspecializationupdatable()->save($doctorspecialization);
                Helper::trackmessage($user, $doctorspecialization, 'doctorspecialization_createoredit', session()->getId(), 'WEB', 'Doctor Specialization Setting Updated');
                $this->toaster('success', 'Doctor Specialization Setting Updated Successfully!!');
            } else {
                $doctorspecialization = $user->doctorspecializationcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $doctorspecialization, 'doctorspecialization_createoredit', session()->getId(), 'WEB', 'Doctor Specialization Setting Created');
                $this->toaster('success', 'Doctor Specialization Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_doctorspecializations_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_doctorspecializations_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_doctorspecializations_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($doctorspecializationid, $type)
    {
        if ($type == 'edit') {
            $doctorspecialization = Doctorspecialization::find($doctorspecializationid);
            $this->name = $doctorspecialization->name;
            $this->note = $doctorspecialization->note;
            $this->active = $doctorspecialization->active;
            $this->doctorspecialization_id = $doctorspecializationid;
        } else {
            $this->showdata = Doctorspecialization::find($doctorspecializationid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->doctorspecialization_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $doctorspecialization = Doctorspecialization::query()
            ->where('active', true)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.doctorsetting.doctorspecialization.doctorspecializationlivewire',
            compact('doctorspecialization'));
    }
}
