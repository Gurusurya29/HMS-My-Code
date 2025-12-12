<?php

namespace App\Http\Livewire\Admin\Settings\Patientvisitsetting\Allergymaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Patientvisitsetting\Allergymaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Allergymasterlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $allergymaster_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:allergymasters,name,' . $this->allergymaster_id,
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
            if ($this->allergymaster_id) {
                $allergymaster = Allergymaster::find($this->allergymaster_id);
                $allergymaster->update($validatedData);
                $user->allergymasterupdatable()->save($allergymaster);
                Helper::trackmessage($user, $allergymaster, 'allergymaster_createoredit', session()->getId(), 'WEB', 'Allergy Master Setting Updated');
                $this->toaster('success', 'Allergy Master Setting Updated Successfully!!');
            } else {
                $allergymaster = $user->allergymastercreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $allergymaster, 'allergymaster_createoredit', session()->getId(), 'WEB', 'Allergy Master Setting Created');
                $this->toaster('success', 'Allergy Master Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_allergymasters_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_allergymasters_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_allergymasters_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($allergymasterid, $type)
    {
        if ($type == 'edit') {
            $allergymaster = Allergymaster::find($allergymasterid);
            $this->name = $allergymaster->name;
            $this->note = $allergymaster->note;
            $this->active = $allergymaster->active;
            $this->allergymaster_id = $allergymasterid;
        } else {
            $this->showdata = Allergymaster::find($allergymasterid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->allergymaster_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $allergymaster = Allergymaster::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.patientvisitsetting.allergymaster.allergymasterlivewire',
            compact('allergymaster'));
    }
}
