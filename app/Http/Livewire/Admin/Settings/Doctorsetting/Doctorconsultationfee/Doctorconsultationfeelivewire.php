<?php

namespace App\Http\Livewire\Admin\Settings\Doctorsetting\Doctorconsultationfee;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Auth\User;
use App\Models\Admin\Settings\Doctorsetting\Doctorconsultationfee;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Doctorconsultationfeelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $doctor_id, $doctorspecialization_id, $insurancefee, $selffee, $note, $active = false;

    public $doctorconsultationfee_id;
    public $showdata;

    public $doctoroption, $doctorspecializationoption;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->doctoroption = User::where('is_accountactive', true)->where('active', true)->pluck('name', 'id');
        $this->doctorspecializationoption = Doctorspecialization::where('active', true)->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'doctor_id' => 'required',
            'doctorspecialization_id' => 'required',
            'insurancefee' => 'required|numeric',
            'selffee' => 'required|numeric',
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
            if ($this->doctorconsultationfee_id) {
                $doctorconsultationfee = Doctorconsultationfee::find($this->doctorconsultationfee_id);
                $doctorconsultationfee->update($validatedData);
                $user->doctorconsultationfeeupdatable()->save($doctorconsultationfee);
                Helper::trackmessage($user, $doctorconsultationfee, 'doctorconsultationfee_createoredit', session()->getId(), 'WEB', 'Doctor Consultation Fee Setting Updated');
                $this->toaster('success', 'Doctor Consultation Fee Setting Updated Successfully!!');
            } else {
                $doctorconsultationfee = $user->doctorconsultationfeecreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $doctorconsultationfee, 'doctorconsultationfee_createoredit', session()->getId(), 'WEB', 'Doctor Consultation Fee Setting Created');
                $this->toaster('success', 'Doctor Consultation Fee Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_doctorconsultationfees_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_doctorconsultationfees_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_doctorconsultationfees_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($doctorconsultationfeeid, $type)
    {
        if ($type == 'edit') {
            $doctorconsultationfee = Doctorconsultationfee::find($doctorconsultationfeeid);
            $this->doctor_id = $doctorconsultationfee->doctor_id;
            $this->doctorspecialization_id = $doctorconsultationfee->doctorspecialization_id;
            $this->insurancefee = $doctorconsultationfee->insurancefee;
            $this->selffee = $doctorconsultationfee->selffee;
            $this->note = $doctorconsultationfee->note;
            $this->active = $doctorconsultationfee->active;
            $this->doctorconsultationfee_id = $doctorconsultationfeeid;
        } else {
            $this->showdata = Doctorconsultationfee::find($doctorconsultationfeeid);
        }
    }

    public function formreset()
    {
        $this->doctor_id = $this->doctorspecialization_id =
        $this->insurancefee = $this->selffee =
        $this->note = $this->doctorconsultationfee_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $doctorconsultationfee = Doctorconsultationfee::query()
            ->where(function ($query) {
                $query->where('uniqid', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.doctorsetting.doctorconsultationfee.doctorconsultationfeelivewire',
            compact('doctorconsultationfee'));
    }
}
