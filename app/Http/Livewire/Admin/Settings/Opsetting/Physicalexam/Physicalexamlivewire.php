<?php

namespace App\Http\Livewire\Admin\Settings\Opsetting\Physicalexam;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Miscellaneous\Helper;
use Livewire\Component;

class Physicalexamlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $physicalexam_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:physicalexams,name,' . $this->physicalexam_id,
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {

            if ($this->physicalexam_id) {
                $physicalexam = physicalexam::find($this->physicalexam_id);
                $physicalexam->update($validatedData);
                $user->physicalexamupdatable()->save($physicalexam);
                Helper::trackmessage(auth()->user(), $physicalexam, 'physicalexam_createoredit', session()->getId(), 'WEB', 'Physical & General Examination Master Setting Updated');
                $this->toaster('success', 'Physical & General Examination Master Setting Updated Successfully!!');
            } else {
                $physicalexam = $user->physicalexamcreatable()
                    ->create($validatedData);
                Helper::trackmessage(auth()->user(), $physicalexam, 'physicalexam_createoredit', session()->getId(), 'WEB', 'Physical & General Examination Master Setting Created');
                $this->toaster('success', 'Physical & General Examination Master Setting Created Successfully!!');
            }

            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror(auth()->user(), 'admin_physicalexams_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror(auth()->user(), 'admin_physicalexams_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror(auth()->user(), 'admin_physicalexams_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($physicalexamid, $type)
    {
        if ($type == 'edit') {
            $physicalexam = physicalexam::find($physicalexamid);
            $this->name = $physicalexam->name;
            $this->note = $physicalexam->note;
            $this->active = $physicalexam->active;
            $this->physicalexam_id = $physicalexamid;
        } else {
            $this->showdata = physicalexam::find($physicalexamid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->physicalexam_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $physicalexam = physicalexam::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.opsetting.physicalexam.physicalexamlivewire',
            compact('physicalexam'));
    }
}
