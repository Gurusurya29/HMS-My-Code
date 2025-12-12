<?php

namespace App\Http\Livewire\Laboratory\Settings\Laboratorymaster\Labreporttemplate;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Laboratory\Settings\Laboratorymaster\Labreporttemplate\Labreporttemplate;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labreporttemplatelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $labreporttemplate_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:70',
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
            if ($this->labreporttemplate_id) {
                $labreporttemplate = Labreporttemplate::find($this->labreporttemplate_id);
                $labreporttemplate->update($validatedData);
                $user->labreporttemplateupdatable()->save($labreporttemplate);
                Helper::trackmessage($user, $labreporttemplate, 'labreporttemplate_createoredit', session()->getId(), 'WEB', 'Report template Updated');
                $this->toaster('success', 'Report template Updated Successfully!!');
            } else {
                $labreporttemplate = $user->labreporttemplatecreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $labreporttemplate, 'labreporttemplate_createoredit', session()->getId(), 'WEB', 'Report template Created');
                $this->toaster('success', 'Report template Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'laboratory_labreporttemplate_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'laboratory_labreporttemplate_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'laboratory_labreporttemplate_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($labreporttemplateid, $type)
    {
        if ($type == 'edit') {
            $labreporttemplate = Labreporttemplate::find($labreporttemplateid);
            $this->name = $labreporttemplate->name;
            $this->note = $labreporttemplate->note;
            $this->active = $labreporttemplate->active;
            $this->labreporttemplate_id = $labreporttemplateid;
        } else {
            $this->showdata = Labreporttemplate::find($labreporttemplateid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->labreporttemplate_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $labreporttemplate = Labreporttemplate::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.laboratory.settings.laboratorymaster.labreporttemplate.labreporttemplatelivewire',
            compact('labreporttemplate'));
    }
}
