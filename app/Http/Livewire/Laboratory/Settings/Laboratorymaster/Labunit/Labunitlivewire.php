<?php

namespace App\Http\Livewire\Laboratory\Settings\Laboratorymaster\Labunit;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Laboratory\Settings\Laboratorymaster\Labunit\Labunit;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labunitlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $labunit_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:labunits,name,' . $this->labunit_id,
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
            if ($this->labunit_id) {
                $labunit = Labunit::find($this->labunit_id);
                $labunit->update($validatedData);
                $user->labunitupdatable()->save($labunit);
                Helper::trackmessage($user, $labunit, 'labunit_createoredit', session()->getId(), 'WEB', 'Unit Updated');
                $this->toaster('success', 'Unit Updated Successfully!!');
            } else {
                $labunit = $user->labunitcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $labunit, 'labunit_createoredit', session()->getId(), 'WEB', 'Unit Created');
                $this->toaster('success', 'Unit Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'laboratory_labunit_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'laboratory_labunit_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'laboratory_labunit_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($labunitid, $type)
    {
        if ($type == 'edit') {
            $labunit = Labunit::find($labunitid);
            $this->name = $labunit->name;
            $this->note = $labunit->note;
            $this->active = $labunit->active;
            $this->labunit_id = $labunitid;
        } else {
            $this->showdata = Labunit::find($labunitid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->labunit_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $labunit = Labunit::query()
            ->where(fn($q) =>
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.laboratory.settings.laboratorymaster.labunit.labunitlivewire',
            compact('labunit'));
    }
}
