<?php

namespace App\Http\Livewire\Admin\Settings\Documentsetting\Medicaldocument;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Documentsetting\Medicaldocument;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Medicaldocumentlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $description, $active = false;

    public $medicaldocument_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:medicaldocuments,name,' . $this->medicaldocument_id,
            'description' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->medicaldocument_id) {
                $medicaldocument = Medicaldocument::find($this->medicaldocument_id);
                $medicaldocument->update($validatedData);
                $user->medicaldocumentupdatable()->save($medicaldocument);
                Helper::trackmessage($user, $medicaldocument, 'medicaldocument_createoredit', session()->getId(), 'WEB', 'Medical Document Setting Updated');
                $this->toaster('success', 'Medical Document Setting Updated Successfully!!');
            } else {
                $medicaldocument = $user->medicaldocumentcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $medicaldocument, 'medicaldocument_createoredit', session()->getId(), 'WEB', 'Medical Document Setting Created');
                $this->toaster('success', 'Medical Document Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_medicaldocuments_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_medicaldocuments_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_medicaldocuments_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($medicaldocumentid, $type)
    {
        if ($type == 'edit') {
            $medicaldocument = Medicaldocument::find($medicaldocumentid);
            $this->name = $medicaldocument->name;
            $this->description = $medicaldocument->description;
            $this->active = $medicaldocument->active;
            $this->medicaldocument_id = $medicaldocumentid;
        } else {
            $this->showdata = Medicaldocument::find($medicaldocumentid);
        }
    }

    public function formreset()
    {
        $this->name = $this->description = $this->medicaldocument_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $medicaldocument = Medicaldocument::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.documentsetting.medicaldocument.medicaldocumentlivewire',
            compact('medicaldocument'));
    }
}
