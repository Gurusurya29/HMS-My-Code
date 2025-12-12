<?php

namespace App\Http\Livewire\Admin\Settings\Patientregisterationsetting\Referencemaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Patientregisterationsetting\Reference;
use App\Models\Miscellaneous\Helper;
use Livewire\Component;

class Referencemasterlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $reference_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:references,name,' . $this->reference_id,
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {

            if ($this->reference_id) {
                $reference = Reference::find($this->reference_id);
                $reference->update($validatedData);
                $user->referenceupdatable()->save($reference);

                Helper::trackmessage($user, $reference, 'reference_createoredit', session()->getId(), 'WEB', 'Reference Setting Updated');
                $this->toaster('success', 'Reference Setting Updated Successfully!!');
            } else {
                $reference = $user->referencecreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $reference, 'reference_createoredit', session()->getId(), 'WEB', 'Reference Setting Created');
                $this->toaster('success', 'Reference Setting Created Successfully!!');
            }

            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_references_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_references_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_references_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($referenceid, $type)
    {
        if ($type == 'edit') {
            $reference = Reference::find($referenceid);
            $this->name = $reference->name;
            $this->note = $reference->note;
            $this->active = $reference->active;
            $this->reference_id = $referenceid;
        } else {
            $this->showdata = Reference::find($referenceid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->reference_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $reference = Reference::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.patientregisterationsetting.referencemaster.referencemasterlivewire',
            compact('reference'));
    }
}
