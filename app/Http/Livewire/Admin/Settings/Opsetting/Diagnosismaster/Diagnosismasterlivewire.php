<?php

namespace App\Http\Livewire\Admin\Settings\Opsetting\Diagnosismaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Miscellaneous\Helper;
use Livewire\Component;

class Diagnosismasterlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $diagnosismaster_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:diagnosismasters,name,' . $this->diagnosismaster_id,
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {

            if ($this->diagnosismaster_id) {
                $diagnosismaster = Diagnosismaster::find($this->diagnosismaster_id);
                $diagnosismaster->update($validatedData);
                $user->diagnosismasterupdatable()->save($diagnosismaster);
                Helper::trackmessage(auth()->user(), $diagnosismaster, 'diagnosismaster_createoredit', session()->getId(), 'WEB', 'Diagnosis Master Setting Updated');
                $this->toaster('success', 'Diagnosis Master Setting Updated Successfully!!');
            } else {
                $diagnosismaster = $user->diagnosismastercreatable()
                    ->create($validatedData);
                Helper::trackmessage(auth()->user(), $diagnosismaster, 'diagnosismaster_createoredit', session()->getId(), 'WEB', 'Diagnosis Master Setting Created');
                $this->toaster('success', 'Diagnosis Master Setting Created Successfully!!');
            }

            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror(auth()->user(), 'admin_diagnosismasters_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror(auth()->user(), 'admin_diagnosismasters_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror(auth()->user(), 'admin_diagnosismasters_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($diagnosismasterid, $type)
    {
        if ($type == 'edit') {
            $diagnosismaster = Diagnosismaster::find($diagnosismasterid);
            $this->name = $diagnosismaster->name;
            $this->note = $diagnosismaster->note;
            $this->active = $diagnosismaster->active;
            $this->diagnosismaster_id = $diagnosismasterid;
        } else {
            $this->showdata = Diagnosismaster::find($diagnosismasterid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->diagnosismaster_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $diagnosismaster = Diagnosismaster::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.opsetting.diagnosismaster.diagnosismasterlivewire',
            compact('diagnosismaster'));
    }
}
