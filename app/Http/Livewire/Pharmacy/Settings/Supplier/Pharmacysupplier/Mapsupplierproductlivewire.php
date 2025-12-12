<?php

namespace App\Http\Livewire\Pharmacy\Settings\Supplier\Pharmacysupplier;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Supplier\Supplierpharmacyproduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Mapsupplierproductlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $supplier_id, $supplier_uuid, $supplier;

    public $showdata;

    public function mount($supplieruuid)
    {
        $this->supplier_uuid = $supplieruuid;
        $supplier = Supplier::where('uuid', $supplieruuid)->first();
        $this->supplier_id = $supplier->id;
        $this->supplier = $supplier;
    }

    protected $rules = [
        'supplier' => 'required',
    ];

    protected function databind($productid, $type)
    {
        $this->showdata = Pharmacyproduct::find($productid);
    }

    public function edithisproduct($id, $operation)
    {
        try {
            DB::beginTransaction();
            if ($operation == "+") {

                Supplierpharmacyproduct::updateOrCreate([
                    'supplier_id' => $this->supplier_id,
                    'pharmacyproduct_id' => $id,
                ], [
                    'active' => true,
                ]);
                $this->toaster('success', 'Product Added Successfully!!');
                DB::commit();
            } else {
                Supplierpharmacyproduct::find($id)->update([
                    'active' => false,
                ]);

                $this->toaster('success', 'Product Removed Successfully!!');
                DB::commit();
                return redirect()->route('pharmacymapsupplierproduct', ['supplieruuid' => $this->supplier_uuid]);
            }

        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacyproduct_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacyproduct_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacyproduct_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function render()
    {
        $pharmacysupplierproduct = Supplierpharmacyproduct::where('supplier_id', $this->supplier_id)
            ->where('active', true)
            ->pluck('pharmacyproduct_id');

        $nonsupplierproducts = Pharmacyproduct::query()
            ->whereNotIn('id', $pharmacysupplierproduct)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $pharmacysupplierproduct = Supplierpharmacyproduct::where('supplier_id', $this->supplier_id)
            ->where('active', true)
            ->get();

        return view('livewire.pharmacy.settings.supplier.pharmacysupplier.mapsupplierproductlivewire', compact('nonsupplierproducts', 'pharmacysupplierproduct'));
    }
}
