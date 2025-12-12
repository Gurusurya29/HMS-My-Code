<?php

namespace App\Http\Livewire\Pharmacy\Settings\Product\Pharmacyproduct;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Pharmacy\Settings\Product\Alternativeproduct;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Alternativepharmacyproductlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $productid, $productname;
    public $showdata;

    protected function rules()
    {
        return [
            'productname' => 'required|min:2|max:70',
        ];
    }

    public function mount($productid)
    {
        $this->productid = $productid;
        $this->productname = Pharmacyproduct::find($productid)->name;
    }

    protected function databind($pharmacydrugmasterid, $type)
    {
        $this->showdata = Pharmacyproduct::find($pharmacydrugmasterid);
    }

    public function edithisproduct($alternativeproductid, $operation)
    {
        try {
            DB::beginTransaction();
            if ($operation == "+") {

                Alternativeproduct::updateOrCreate([
                    'pharmacyproduct_id' => $this->productid,
                    'alternativeproduct_id' => $alternativeproductid,
                ], [
                    'active' => true,
                ]);

                Alternativeproduct::updateOrCreate([
                    'alternativeproduct_id' => $this->productid,
                    'pharmacyproduct_id' => $alternativeproductid,
                ], [
                    'active' => true,
                ]);

                $this->toaster('success', 'Product Added Successfully!!');
                DB::commit();
            } else {
                Alternativeproduct::where('pharmacyproduct_id', $alternativeproductid)
                    ->update([
                        'active' => false,
                    ]);

                Alternativeproduct::where('alternativeproduct_id', $alternativeproductid)
                    ->update([
                        'active' => false,
                    ]);

                $this->toaster('success', 'Product Removed Successfully!!');
                DB::commit();
                if ($this->currentuser()->usertype == 'ADMIN') {
                    return redirect()->route('adminalternativepharmacyproduct', ['productid' => $this->productid]);
                } else {
                    return redirect()->route('alternativepharmacyproduct', ['productid' => $this->productid]);
                }
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
        $alternaiveproduct = Alternativeproduct::where('pharmacyproduct_id', $this->productid)
            ->where('active', true)
            ->pluck('alternativeproduct_id');

        $nonalternativeproduct = Pharmacyproduct::query()
            ->where('id', '!=', $this->productid)
            ->whereNotIn('id', $alternaiveproduct)
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

        $alternaiveproduct = Alternativeproduct::where('pharmacyproduct_id', $this->productid)
            ->where('active', true)
            ->get();

        return view('livewire.pharmacy.settings.product.pharmacyproduct.alternativepharmacyproductlivewire', compact('nonalternativeproduct', 'alternaiveproduct'));
    }
}
