<?php

namespace App\Http\Livewire\Pharmacy\Settings\Product\Pharmacyproduct;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use App\Models\Pharmacy\Settings\Category\Pharmacysubcategory;
use App\Models\Pharmacy\Settings\Drugmaster\Genaric\Pharmacygenaric;
use App\Models\Pharmacy\Settings\Drugmaster\Manufacture\Pharmacymanufacture;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pharmacyproductlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note;

    public $pharmacymanufacture_id, $pharmacygenaric_id;
    public $pharmacymanufacture_option, $pharmacygenaric_option;

    public $pharmacycategory_id, $pharmacysubcategory_id;
    public $pharmacycategory_option, $pharmacysubcategory_option = [];

    public $product_code, $product_sku, $hsn, $min_stock, $mrp,
    $purchase_rate, $sgst, $cgst, $igst, $cess;
    public $stock_required = false, $active = false;

    public $pharmacydrugmaster_id;
    public $showdata;
    public $is_schedule = false;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->pharmacycategory_option = Pharmacycategory::where('active', true)->pluck('name', 'id');
        $this->pharmacymanufacture_option = Pharmacymanufacture::where('active', true)->pluck('name', 'id');
        $this->pharmacygenaric_option = Pharmacygenaric::where('active', true)->pluck('name', 'id');
    }

    public function updatedPharmacycategoryId()
    {
        if ($this->pharmacycategory_id) {
            $this->pharmacysubcategory_option = Pharmacysubcategory::where('pharmacycategory_id', $this->pharmacycategory_id)
                ->where('active', true)
                ->pluck('name', 'id');
        } else {
            $this->pharmacysubcategory_option = [];
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:70|unique:pharmacyproducts,name,' . $this->pharmacydrugmaster_id,
            'note' => 'nullable|max:255',
            'pharmacycategory_id' => 'required',
            'pharmacysubcategory_id' => 'nullable',
            'pharmacymanufacture_id' => 'nullable',
            'pharmacygenaric_id' => 'nullable',
            'product_code' => 'nullable',
            'product_sku' => 'required',
            'hsn' => 'required',
            'mrp' => 'required|numeric',
            'purchase_rate' => 'required|numeric',
            'sgst' => 'required|numeric',
            'cgst' => 'required|numeric',
            'igst' => 'required|numeric',
            'cess' => 'required|numeric',
            'stock_required' => 'nullable',
            'active' => 'nullable',
            'is_schedule' => 'nullable',
            'min_stock' => 'required_if:stock_required,==,true',
        ];
    }

    protected $messages = [
        'pharmacycategory_id.required' => 'Category is required',
        'pharmacysubcategory_id.required' => 'Sub Category is required',
        'min_stock.required_if' => 'Minimum stock is required',
    ];

    public function store()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            if ($this->pharmacydrugmaster_id) {
                $pharmacydrugmaster = Pharmacyproduct::find($this->pharmacydrugmaster_id);
                $pharmacydrugmaster->update($validatedData);
                $this->currentuser()->pharmacyproductupdatable()->save($pharmacydrugmaster);

                Helper::trackmessage($this->currentuser(), $pharmacydrugmaster, 'pharmacydrugmaster_createoredit', session()->getId(), 'WEB', 'Product Updated');
                $this->toaster('success', 'Product Updated Successfully!!');
            } else {
                $pharmacydrugmaster = $this->currentuser()->pharmacyproductcreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $pharmacydrugmaster, 'pharmacydrugmaster_createoredit', session()->getId(), 'WEB', 'Product Created');
                $this->toaster('success', 'Product Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacyproduct_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacyproduct_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacyproduct_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($pharmacydrugmasterid, $type)
    {
        if ($type == 'edit') {
            $pharmacydrugmaster = Pharmacyproduct::find($pharmacydrugmasterid);
            $this->name = $pharmacydrugmaster->name;
            $this->note = $pharmacydrugmaster->note;
            $this->pharmacydrugmaster_id = $pharmacydrugmasterid;
            $this->pharmacymanufacture_id = $pharmacydrugmaster->pharmacymanufacture_id;
            $this->pharmacygenaric_id = $pharmacydrugmaster->pharmacygenaric_id;
            $this->pharmacycategory_id = $pharmacydrugmaster->pharmacycategory_id;
            $this->pharmacysubcategory_id = $pharmacydrugmaster->pharmacysubcategory_id;
            $this->product_code = $pharmacydrugmaster->product_code;
            $this->product_sku = $pharmacydrugmaster->product_sku;
            $this->hsn = $pharmacydrugmaster->hsn;
            $this->min_stock = $pharmacydrugmaster->min_stock;
            $this->mrp = $pharmacydrugmaster->mrp;
            $this->purchase_rate = $pharmacydrugmaster->purchase_rate;
            $this->sgst = $pharmacydrugmaster->sgst;
            $this->cgst = $pharmacydrugmaster->cgst;
            $this->igst = $pharmacydrugmaster->igst;
            $this->cess = $pharmacydrugmaster->cess;
            $this->stock_required = $pharmacydrugmaster->stock_required;
            $this->active = $pharmacydrugmaster->active;
            $this->is_schedule = $pharmacydrugmaster->is_schedule;
        } else {
            $this->showdata = Pharmacyproduct::find($pharmacydrugmasterid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->pharmacydrugmaster_id = $this->pharmacymanufacture_id =
        $this->pharmacygenaric_id = $this->pharmacycategory_id = $this->pharmacysubcategory_id =
        $this->product_code = $this->product_sku = $this->hsn = $this->min_stock = $this->mrp =
        $this->purchase_rate = $this->sgst = $this->cgst = $this->igst = $this->cess = null;
        $this->stock_required = $this->active = $this->is_schedule = false;
        $this->resetValidation();
    }

    public function render()
    {
        $pharmacyproduct = Pharmacyproduct::query()
            ->where(function ($query) {
                $query->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('hsn', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('product_sku', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('pharmacycategoryname', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    );
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.settings.product.pharmacyproduct.pharmacyproductlivewire',
            compact('pharmacyproduct'));
    }
}
