<?php

namespace App\Http\Livewire\Admin\Settings\Patientvisitsetting\Insurancecompanymaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
use App\Models\Miscellaneous\Helper;
use Livewire\Component;

class Insurancecompanymasterlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;
    public $insurancecompany_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:insurancecompanies,name,' . $this->insurancecompany_id,
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {

            if ($this->insurancecompany_id) {
                $insurancecompany = Insurancecompany::find($this->insurancecompany_id);
                $insurancecompany->update($validatedData);
                $user->insurancecompanyupdatable()->save($insurancecompany);
                Helper::trackmessage($user, $insurancecompany, 'insurancecompany_createoredit', session()->getId(), 'WEB', 'Insurance Company Updated');
                $this->toaster('success', 'Insurance Company Updated Successfully!!');
            } else {
                $insurancecompany = $user->insurancecompanycreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $insurancecompany, 'insurancecompany_createoredit', session()->getId(), 'WEB', 'Insurance Company Created');
                $this->toaster('success', 'Insurance Company Created Successfully!!');
            }

            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_insurancecompanys_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_insurancecompanys_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_insurancecompanys_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($insurancecompanyid, $type)
    {
        if ($type == 'edit') {
            $insurancecompany = Insurancecompany::find($insurancecompanyid);
            $this->name = $insurancecompany->name;
            $this->note = $insurancecompany->note;
            $this->active = $insurancecompany->active;
            $this->insurancecompany_id = $insurancecompanyid;
        } else {
            $this->showdata = Insurancecompany::find($insurancecompanyid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->insurancecompany_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $insurancecompany = Insurancecompany::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.patientvisitsetting.insurancecompanymaster.insurancecompanymasterlivewire',
            compact('insurancecompany'));
    }
}
