<?php

namespace App\Http\Livewire\Pharmacy\Settings\Category\Pharmacysubcategory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use App\Models\Pharmacy\Settings\Category\Pharmacysubcategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pharmacysubcategorylivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false, $pharmacycategory_id;

    public $pharmacysubcategory_id, $pharmacycategorylist;
    public $showdata;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->pharmacycategorylist = Pharmacycategory::where('active', true)->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:pharmacysubcategories,name,' . $this->pharmacysubcategory_id,
            'pharmacycategory_id' => 'required',
            'active' => 'nullable|boolean',
            'note' => 'nullable|max:255',
        ];
    }

    protected $messages = [
        'pharmacycategory_id.required' => 'Category is required.',
    ];

    public function store()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            if ($this->pharmacysubcategory_id) {
                $pharmacysubcategory = Pharmacysubcategory::find($this->pharmacysubcategory_id);
                $pharmacysubcategory->update($validatedData);
                $this->currentuser()->pharmacysubcategoryupdatable()->save($pharmacysubcategory);

                Helper::trackmessage($this->currentuser(), $pharmacysubcategory, 'pharmacysubcategory_createoredit', session()->getId(), 'WEB', 'Sub Cateogry Updated');
                $this->toaster('success', 'Sub Cateogry Updated Successfully!!');
            } else {
                $pharmacysubcategory = $this->currentuser()->pharmacysubcategorycreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $pharmacysubcategory, 'pharmacysubcategory_createoredit', session()->getId(), 'WEB', 'Sub Cateogry Created');
                $this->toaster('success', 'Sub Cateogry Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacysubcategories_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacysubcategories_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacysubcategories_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($pharmacysubcategoryid, $type)
    {
        if ($type == 'edit') {
            $pharmacysubcategory = Pharmacysubcategory::find($pharmacysubcategoryid);
            $this->name = $pharmacysubcategory->name;
            $this->note = $pharmacysubcategory->note;
            $this->pharmacycategory_id = $pharmacysubcategory->pharmacycategory_id;
            $this->active = $pharmacysubcategory->active;
            $this->pharmacysubcategory_id = $pharmacysubcategoryid;
        } else {
            $this->showdata = Pharmacysubcategory::find($pharmacysubcategoryid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->pharmacysubcategory_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $pharmacysubcategory = Pharmacysubcategory::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.settings.category.pharmacysubcategory.pharmacysubcategorylivewire',
            compact('pharmacysubcategory'));
    }
}
