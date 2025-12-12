<?php

namespace App\Http\Livewire\Admin\Settings\Mastersetting\Locationmaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Mastersetting\Locationmaster;
use App\Models\Miscellaneous\Helper;
use Livewire\Component;

class Locationmasterlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note;

    public $locationmaster_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:70',
            'note' => 'nullable|max:255',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {

            if ($this->locationmaster_id) {
                $locationmaster = Locationmaster::find($this->locationmaster_id);
                $locationmaster->update($validatedData);
                Helper::trackmessage(auth()->user(), $locationmaster, 'locationmaster_createoredit', session()->getId(), 'WEB', 'Location Master Setting Updated');
                $this->toaster('success', 'Location Master Setting Updated Successfully!!');
            } else {
                $locationmaster = Locationmaster::create($validatedData);
                Helper::trackmessage(auth()->user(), $locationmaster, 'locationmaster_createoredit', session()->getId(), 'WEB', 'Location Master Setting Created');
                $this->toaster('success', 'Location Master Setting Created Successfully!!');
            }

            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror(auth()->user(), 'admin_locationmasters_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror(auth()->user(), 'admin_locationmasters_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror(auth()->user(), 'admin_locationmasters_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($locationmasterid, $type)
    {
        if ($type == 'edit') {
            $locationmaster = Locationmaster::find($locationmasterid);
            $this->name = $locationmaster->name;
            $this->note = $locationmaster->note;
            $this->locationmaster_id = $locationmasterid;
        } else {
            $this->showdata = Locationmaster::find($locationmasterid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->locationmaster_id = null;
        $this->resetValidation();
    }

    public function render()
    {
        $locationmaster = Locationmaster::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.mastersetting.locationmaster.locationmasterlivewire',
            compact('locationmaster'));
    }
}
