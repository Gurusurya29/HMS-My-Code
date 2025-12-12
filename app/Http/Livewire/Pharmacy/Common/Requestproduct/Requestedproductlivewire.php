<?php

namespace App\Http\Livewire\Pharmacy\Common\Requestproduct;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use App\Models\Pharmacy\Settings\Category\Pharmacysubcategory;
use App\Models\Pharmacy\Settings\Drugmaster\Genaric\Pharmacygenaric;
use App\Models\Pharmacy\Settings\Drugmaster\Manufacture\Pharmacymanufacture;
use DB;
use Livewire\Component;

class Requestedproductlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $pharmacycategory_option, $pharmacymanufacture_option, $pharmacygenaric_option;

    public $pharmacycategory_id, $pharmacysubcategory_id;
    public $pharmacysubcategory_option = [];

    public $name, $note, $product_code, $product_sku, $hsn, $min_stock, $mrp,
    $purchase_rate, $sgst, $cgst, $igst, $cess, $stock_required = false, $is_schedule = false;

    public function mount()
    {
        $this->pharmacycategory_option = Pharmacycategory::where('active', true)->pluck('name', 'id');
        $this->pharmacymanufacture_option = Pharmacymanufacture::where('active', true)->pluck('name', 'id');
        $this->pharmacygenaric_option = Pharmacygenaric::where('active', true)->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:70',
            'note' => 'nullable|max:255',
            'pharmacycategory_id' => 'nullable',
            'pharmacysubcategory_id' => 'nullable',
            'pharmacymanufacture_id' => 'nullable',
            'pharmacygenaric_id' => 'nullable',
            'product_code' => 'nullable',
            'product_sku' => 'nullable',
            'hsn' => 'nullable',
            'mrp' => 'nullable|numeric',
            'purchase_rate' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
            'cgst' => 'nullable|numeric',
            'igst' => 'nullable|numeric',
            'cess' => 'nullable|numeric',
            'stock_required' => 'nullable|boolean',
            'is_schedule' => 'nullable|boolean',
            'min_stock' => 'required_if:stock_required,==,true',
        ];
    }

    protected $messages = [
        'min_stock.required_if' => 'Minimum stock is required',
    ];

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

    public function store()
    {
        $validatedData = $this->validate();
        $user = $this->currentuser();

        try {
            DB::beginTransaction();
            $pharmrequestedproduct = $user->pharmreqproductcreatable()->create($validatedData);
            Helper::trackmessage($user, $pharmrequestedproduct, 'pharmrequestedproduct_createoredit', session()->getId(), 'WEB', 'Product Created');
            $this->toaster('success', 'Product Created Successfully!!');

            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
            $this->dispatch('requested_product_created');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'pharmacy_pharmacyproduct_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'pharmacy_pharmacyproduct_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'pharmacy_pharmacyproduct_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->pharmacymanufacture_id =
        $this->pharmacygenaric_id = $this->pharmacycategory_id = $this->pharmacysubcategory_id =
        $this->product_code = $this->product_sku = $this->hsn = $this->min_stock = $this->mrp =
        $this->purchase_rate = $this->sgst = $this->cgst = $this->igst = $this->cess = null;
        $this->stock_required = false;
        $this->is_schedule = false;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.pharmacy.common.requestproduct.requestedproductlivewire');
    }
}
