<?php

namespace App\Http\Livewire\Pharmacy\Settings\Drugmaster\Pharmacymanufacture;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use App\Models\Pharmacy\Settings\Drugmaster\Manufacture\Pharmacymanufacture;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pharmacymanufacturelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $active = false, $note, $contact_no, $address, $pharmacycategory_id;

    public $pharmacymanufacture_id;
    public $showdata;
    public $category_list;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->category_list = Pharmacycategory::where('active', true)->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:pharmacymanufactures,name,' . $this->pharmacymanufacture_id,
            'active' => 'nullable|boolean',
            'note' => 'nullable|max:255',
            'contact_no' => 'nullable|digits:10',
            'address' => 'nullable|string',
            'pharmacycategory_id' => 'nullable',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            if ($this->pharmacymanufacture_id) {
                $pharmacymanufacture = Pharmacymanufacture::find($this->pharmacymanufacture_id);
                $pharmacymanufacture->update($validatedData);
                $this->currentuser()->pharmacymanufactureupdatable()->save($pharmacymanufacture);

                Helper::trackmessage($this->currentuser(), $pharmacymanufacture, 'pharmacymanufacture_createoredit', session()->getId(), 'WEB', 'Manufacture Name Updated');
                $this->toaster('success', 'Manufacture Name Updated Successfully!!');
            } else {
                $pharmacymanufacture = $this->currentuser()->pharmacymanufacturecreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $pharmacymanufacture, 'pharmacymanufacture_createoredit', session()->getId(), 'WEB', 'Manufacture Name Created');
                $this->toaster('success', 'Manufacture Name Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacymanufactures_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacymanufactures_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacymanufactures_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($pharmacymanufactureid, $type)
    {
        if ($type == 'edit') {
            $pharmacymanufacture = Pharmacymanufacture::find($pharmacymanufactureid);
            $this->name = $pharmacymanufacture->name;
            $this->note = $pharmacymanufacture->note;
            $this->active = $pharmacymanufacture->active;
            $this->contact_no = $pharmacymanufacture->contact_no;
            $this->address = $pharmacymanufacture->address;
            $this->pharmacycategory_id = $pharmacymanufacture->pharmacycategory_id;
            $this->pharmacymanufacture_id = $pharmacymanufactureid;
        } else {
            $this->showdata = Pharmacymanufacture::find($pharmacymanufactureid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->pharmacymanufacture_id =
        $this->contact_no = $this->address = $this->pharmacycategory_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $pharmacymanufacture = Pharmacymanufacture::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.settings.drugmaster.pharmacymanufacture.pharmacymanufacturelivewire',
            compact('pharmacymanufacture'));
    }
}
