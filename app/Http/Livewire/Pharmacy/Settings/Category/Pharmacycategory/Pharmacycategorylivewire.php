<?php

namespace App\Http\Livewire\Pharmacy\Settings\Category\Pharmacycategory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pharmacycategorylivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $active = false, $note;

    public $pharmacycategory_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:pharmacycategories,name,' . $this->pharmacycategory_id,
            'active' => 'nullable|boolean',
            'note' => 'nullable|max:255',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            if ($this->pharmacycategory_id) {
                $pharmacycategory = Pharmacycategory::find($this->pharmacycategory_id);
                $pharmacycategory->update($validatedData);
                $this->currentuser()->pharmacycategoryupdatable()->save($pharmacycategory);

                Helper::trackmessage($this->currentuser(), $pharmacycategory, 'pharmacycategory_createoredit', session()->getId(), 'WEB', 'Cateogry Updated');
                $this->toaster('success', 'Cateogry Updated Successfully!!');
            } else {
                $pharmacycategory = $this->currentuser()->pharmacycategorycreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $pharmacycategory, 'pharmacycategory_createoredit', session()->getId(), 'WEB', 'Cateogry Created');
                $this->toaster('success', 'Cateogry Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacycategories_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacycategories_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacycategories_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($pharmacycategoryid, $type)
    {
        if ($type == 'edit') {
            $pharmacycategory = Pharmacycategory::find($pharmacycategoryid);
            $this->name = $pharmacycategory->name;
            $this->note = $pharmacycategory->note;
            $this->active = $pharmacycategory->active;
            $this->pharmacycategory_id = $pharmacycategoryid;
        } else {
            $this->showdata = Pharmacycategory::find($pharmacycategoryid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->pharmacycategory_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $pharmacycategory = Pharmacycategory::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.settings.category.pharmacycategory.pharmacycategorylivewire',
            compact('pharmacycategory'));
    }
}
