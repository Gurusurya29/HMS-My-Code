<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseplanning;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Purchase\Purchaseplanning\Pharmpurchaseplan;
use App\Models\Pharmacy\Purchase\Purchaseplanning\Pharmpurchaseplanitem;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Purchaseplanningcreateoreditlivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $query, $suppliers = [], $normalstock = [];
    public $supplier, $note;
    public $highlightIndex, $contact_name,
    $mobile_number, $supplier_name, $issupplierselected;

    public $stocklessproductid = [], $abt2beproductid = [], $extproductid = [];
    //Stockless
    public $stocklessproductname, $stocklessproductprice, $stocklessproductqunatity, $stocklessproducttotal;
    public $stocklessproductgenaric, $stocklessproductmanufacture, $stocklessproductcgst, $stocklessproductsgst;
    public $stocklessproductcgstamt, $stocklessproductsgstamt;
    public $stocklessproductcode, $stocklessproducthsn;
    //About to be stockless
    public $abt2beproductname, $abt2beproductprice, $abt2beproductqunatity,
    $abt2beproducttotal, $abt2beproductgenaric, $abt2beproductmanufacture, $abt2beminstock,
    $abt2beproductcgst, $abt2beproductsgst, $abt2beproductcgstamt,
    $abt2beproductsgstamt, $abt2beproductcode, $abt2beproducthsn, $abt2beproductstock;
    //Extra Product
    public $extproductname, $extproductgenaric,
    $extproductmanufacture, $extproductcgst, $extproductcgstamt,
    $extproductsgst, $extproductsgstamt, $extproductprice,
    $extproductqunatity, $extproducttotal, $extproductcode, $extproducthsn, $extproductstock;

    public $grandtotal, $taxableamt, $taxamt;
    public $purchaseplanid;

    protected $listeners = ['productselected'];

    public function mount($purchaseplanninguuid)
    {
        if ($purchaseplanninguuid) {
            $purchaseplan = Pharmpurchaseplan::where('uuid', $purchaseplanninguuid)->first();
            $this->purchaseplanid = $purchaseplan->id;

            $this->supplier = $purchaseplan->supplier;

            $this->contact_name = $purchaseplan->supplier_contact_name;
            $this->mobile_number = $purchaseplan->supplier_mobile_no;
            $this->supplier_name = $purchaseplan->supplier_companyname;
            $this->query = $purchaseplan->supplier_companyname;

            $this->note = $purchaseplan->note;
            $this->purchase_date = Carbon::parse($purchaseplan->planning_date)->format('Y-m-d');
            $this->issupplierselected = true;

            if (count($purchaseplan->outofstock()) > 0) {
                foreach ($purchaseplan->outofstock() as $value) {
                    $this->stocklessproductid[] = $value->pharmacyproduct_id;
                    $this->stocklessproductname[] = $value->pharmacyproduct_name;
                    $this->stocklessproductprice[] = $value->price;
                    $this->stocklessproductqunatity[] = $value->quantity;
                    $this->stocklessproducttotal[] = $value->total;
                    $this->stocklessproductgenaric[] = $value->genaric_name;
                    $this->stocklessproductmanufacture[] = $value->manufacture_name;
                    $this->stocklessproductcgst[] = $value->cgst;
                    $this->stocklessproductsgst[] = $value->sgst;
                    $this->stocklessproductcgstamt[] = $value->cgst_amt;
                    $this->stocklessproductsgstamt[] = $value->sgst_amt;
                    $this->stocklessproductcode[] = $value->product_code;
                    $this->stocklessproducthsn[] = $value->hsn;
                }
            }

            if (count($purchaseplan->abt2beoutofstock()) > 0) {
                foreach ($purchaseplan->abt2beoutofstock() as $value) {
                    $this->abt2beproductid[] = $value->pharmacyproduct_id;
                    $this->abt2beproductname[] = $value->pharmacyproduct_name;
                    $this->abt2beproductprice[] = $value->price;
                    $this->abt2beproductqunatity[] = $value->quantity;
                    $this->abt2beproducttotal[] = $value->total;
                    $this->abt2beproductgenaric[] = $value->genaric_name;
                    $this->abt2beproductmanufacture[] = $value->manufacture_name;
                    $this->abt2beminstock[] = $value->min_stock;
                    $this->abt2beproductcgst[] = $value->cgst;
                    $this->abt2beproductsgst[] = $value->sgst;
                    $this->abt2beproductcgstamt[] = $value->cgst_amt;
                    $this->abt2beproductsgstamt[] = $value->sgst_amt;
                    $this->abt2beproductcode[] = $value->product_code;
                    $this->abt2beproducthsn[] = $value->hsn;
                    $this->abt2beproductstock[] = $value->pharmacyproduct->stock;
                }
            }

            if (count($purchaseplan->extstock()) > 0) {
                foreach ($purchaseplan->extstock() as $value) {
                    $this->extproductid[] = $value->pharmacyproduct_id;
                    $this->extproductname[] = $value->pharmacyproduct_name;
                    $this->extproductprice[] = $value->price;
                    $this->extproductqunatity[] = $value->quantity;
                    $this->extproducttotal[] = $value->total;
                    $this->extproductgenaric[] = $value->genaric_name;
                    $this->extproductmanufacture[] = $value->manufacture_name;
                    $this->extproductcgst[] = $value->cgst;
                    $this->extproductsgst[] = $value->sgst;
                    $this->extproductcgstamt[] = $value->cgst_amt;
                    $this->extproductsgstamt[] = $value->sgst_amt;
                    $this->extproductcode[] = $value->product_code;
                    $this->extproducthsn[] = $value->hsn;
                    $this->extproductstock[] = $value->pharmacyproduct->stock;
                }
            }

            $this->grandtotal = $purchaseplan->grand_total;
            $this->taxableamt = $purchaseplan->taxableamt;
            $this->taxamt = $purchaseplan->taxamt;
        } else {
            $this->resetData();
            $this->purchase_date = Carbon::today()->format('Y-m-d');
        }
    }

    protected function rules()
    {
        return [
            'purchase_date' => 'required|after:' . Carbon::today()->subDays(1),
            'stocklessproductprice.*' => 'required|numeric|min:1',
            'stocklessproductqunatity.*' => 'required|numeric|min:1',

            'abt2beproductprice.*' => 'required|numeric|min:1',
            'abt2beproductqunatity.*' => 'required|numeric|min:1',

            'extproductprice.*' => 'required|numeric|min:1',
            'extproductqunatity.*' => 'required|numeric|min:1',
        ];
    }

    protected $messages = [
        'purchase_date.after' => "Invalid Date",
        'stocklessproductprice.*.required' => "Required",
        'stocklessproductprice.*.numeric' => "Invalid",
        'stocklessproductprice.*.min' => "Invalid",

        'stocklessproductqunatity.*.required' => "Required",
        'stocklessproductqunatity.*.numeric' => "Invalid",
        'stocklessproductqunatity.*.min' => "Invalid",

        'abt2beproductprice.*.required' => "Required",
        'abt2beproductprice.*.numeric' => "Invalid",
        'abt2beproductprice.*.min' => "Invalid",

        'abt2beproductqunatity.*.required' => "Required",
        'abt2beproductqunatity.*.numeric' => "Invalid",
        'abt2beproductqunatity.*.min' => "Invalid",

        'extproductprice.*.required' => "Required",
        'extproductprice.*.numeric' => "Invalid",
        'extproductprice.*.min' => "Invalid",

        'extproductqunatity.*.required' => "Required",
        'extproductqunatity.*.numeric' => "Invalid",
        'extproductqunatity.*.min' => "Invalid",
    ];

    public function resetData()
    {
        $this->query = '';
        $this->suppliers = [];
        $this->highlightIndex = 0;
        $this->note = null;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->suppliers) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->suppliers) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectSupplier()
    {
        $supplier = $this->suppliers[$this->highlightIndex] ?? null;
        if ($supplier) {
            $this->selecthissupplier($this->suppliers[$this->highlightIndex]['id']);
        }
    }

    public function selecthissupplier($supplier)
    {
        $supplier = Supplier::find($supplier);
        $this->tableformreset();
        $this->supplier = $supplier;
        $this->mobile_number = $supplier->contact_mobile_no;
        $this->query = $supplier->company_name;
        $this->supplier_name = $supplier->company_name;
        $this->issupplierselected = true;
        $this->contact_name = $supplier->company_person_name;
        foreach ($supplier->stocklessproducts() as $key => $value) {
            $this->stocklessproductid[] = $value->id;
            $this->stocklessproductname[] = $value->name;
            $this->stocklessproductgenaric[] = $value->pharmacygenaricname?->name;
            $this->stocklessproductmanufacture[] = $value->pharmacymanufacturename?->name;
            $this->stocklessproductcgst[] = $value->cgst;
            $this->stocklessproductcgstamt[] = ($value->cgst / 100) * (($value->purchase_rate ? $value->purchase_rate : 0) * ($value->min_stock ? $value->min_stock - $value->stock : 0));
            $this->stocklessproductsgst[] = $value->sgst;
            $this->stocklessproductsgstamt[] = ($value->sgst / 100) * (($value->purchase_rate ? $value->purchase_rate : 0) * ($value->min_stock ? $value->min_stock - $value->stock : 0));
            $this->stocklessproductprice[] = $value->purchase_rate ? $value->purchase_rate : '';
            $this->stocklessproductqunatity[] = $value->stock_required ? $value->min_stock : '';
            $this->stocklessproducttotal[] = (is_numeric($this->stocklessproductqunatity[$key]) ? $this->stocklessproductqunatity[$key] : 0)
                 * (is_numeric($this->stocklessproductprice[$key]) ? $this->stocklessproductprice[$key] : 0);
            $this->stocklessproductcode[] = $value->product_code;
            $this->stocklessproducthsn[] = $value->hsn;
        }
        foreach ($supplier->abouttobestockless() as $key => $value) {
            $this->abt2beproductid[] = $value->id;
            $this->abt2beproductname[] = $value->name;
            $this->abt2beproductgenaric[] = $value->pharmacygenaricname?->name;
            $this->abt2beproductmanufacture[] = $value->pharmacymanufacturename?->name;
            $this->abt2beminstock[] = $value->min_stock;
            $this->abt2beproductcgst[] = $value->cgst;
            $this->abt2beproductcgstamt[] = ($value->cgst / 100) * (($value->purchase_rate ? $value->purchase_rate : 0) * ($value->min_stock ? $value->min_stock - $value->stock : 0));
            $this->abt2beproductsgst[] = $value->sgst;
            $this->abt2beproductsgstamt[] = ($value->sgst / 100) * (($value->purchase_rate ? $value->purchase_rate : 0) * ($value->min_stock ? $value->min_stock - $value->stock : 0));
            $this->abt2beproductprice[] = $value->purchase_rate ? $value->purchase_rate : '';
            $this->abt2beproductqunatity[] = ($value->min_stock - $value->stock);
            $this->abt2beproducttotal[] = (is_numeric($this->abt2beproductqunatity[$key]) ? $this->abt2beproductqunatity[$key] : 0)
                 * (is_numeric($this->abt2beproductprice[$key]) ? $this->abt2beproductprice[$key] : 0);
            $this->abt2beproductcode[] = $value->product_code;
            $this->abt2beproducthsn[] = $value->hsn;
            $this->abt2beproductstock[] = $value->stock;
        }
        $this->totalcalculation();

        $this->normalstock = $supplier->normalproduct();
    }

    public function productlivevalidation($value, $key)
    {
        if ($value == 'stockless') {
            $total = (is_numeric($this->stocklessproductqunatity[$key]) ? $this->stocklessproductqunatity[$key] : 0)
                 * (is_numeric($this->stocklessproductprice[$key]) ? $this->stocklessproductprice[$key] : 0);

            $this->stocklessproductcgstamt[$key] = ($this->stocklessproductcgst[$key] / 100) * $total;
            $this->stocklessproductsgstamt[$key] = ($this->stocklessproductsgst[$key] / 100) * $total;
            $this->stocklessproducttotal[$key] = $total + $this->stocklessproductcgstamt[$key] + $this->stocklessproductsgstamt[$key];

        } else if ($value == 'abt2be') {
            $total = (is_numeric($this->abt2beproductqunatity[$key]) ? $this->abt2beproductqunatity[$key] : 0)
                 * (is_numeric($this->abt2beproductprice[$key]) ? $this->abt2beproductprice[$key] : 0);

            $this->abt2beproductcgstamt[$key] = ($this->abt2beproductcgst[$key] / 100) * $total;
            $this->abt2beproductsgstamt[$key] = ($this->abt2beproductsgst[$key] / 100) * $total;
            $this->abt2beproducttotal[$key] = $total + $this->abt2beproductcgstamt[$key] + $this->abt2beproductsgstamt[$key];
        } else if ($value = "extproduct") {
            $total = (is_numeric($this->extproductqunatity[$key]) ? $this->extproductqunatity[$key] : 0)
                 * (is_numeric($this->extproductprice[$key]) ? $this->extproductprice[$key] : 0);

            $this->extproductcgstamt[$key] = ($this->extproductcgst[$key] / 100) * $total;
            $this->extproductsgstamt[$key] = ($this->extproductsgst[$key] / 100) * $total;
            $this->extproducttotal[$key] = $total + $this->extproductcgstamt[$key] + $this->extproductsgstamt[$key];
        }

        $this->totalcalculation();
    }

    public function totalcalculation()
    {
        $grandtotal = collect($this->stocklessproducttotal)->sum() + collect($this->abt2beproducttotal)->sum() + collect($this->extproducttotal)->sum();
        $this->taxamt = collect($this->stocklessproductcgstamt)->sum() + collect($this->stocklessproductsgstamt)->sum() +
        collect($this->abt2beproductcgstamt)->sum() + collect($this->abt2beproductsgstamt)->sum() +
        collect($this->extproductcgstamt)->sum() + collect($this->extproductsgstamt)->sum();
        $this->taxableamt = $grandtotal - $this->taxamt;

        $whole = floor($grandtotal);
        $fraction = $grandtotal - $whole;
        if ($fraction > 0.49) {
            $this->grandtotal = $whole + 1;
        } else {
            $this->grandtotal = $whole;
        }
    }

    public function removeitem($value, $key)
    {
        if ($value == "stockless") {
            unset($this->stocklessproductid[$key]);
            unset($this->stocklessproductname[$key]);
            unset($this->stocklessproductgenaric[$key]);
            unset($this->stocklessproductmanufacture[$key]);
            unset($this->stocklessproductcgst[$key]);
            unset($this->stocklessproductcgstamt[$key]);
            unset($this->stocklessproductsgst[$key]);
            unset($this->stocklessproductsgstamt[$key]);
            unset($this->stocklessproductprice[$key]);
            unset($this->stocklessproductqunatity[$key]);
            unset($this->stocklessproducttotal[$key]);
            unset($this->stocklessproductcode[$key]);
            unset($this->stocklessproducthsn[$key]);
        } else if ($value == "abt2be") {
            unset($this->abt2beproductid[$key]);
            unset($this->abt2beproductname[$key]);
            unset($this->abt2beproductgenaric[$key]);
            unset($this->abt2beproductmanufacture[$key]);
            unset($this->abt2beminstock[$key]);
            unset($this->abt2beproductcgst[$key]);
            unset($this->abt2beproductcgstamt[$key]);
            unset($this->abt2beproductsgst[$key]);
            unset($this->abt2beproductsgstamt[$key]);
            unset($this->abt2beproductprice[$key]);
            unset($this->abt2beproductqunatity[$key]);
            unset($this->abt2beproducttotal[$key]);
            unset($this->abt2beproductcode[$key]);
            unset($this->abt2beproducthsn[$key]);
            unset($this->abt2beproductstock[$key]);
        } else if ($value == "extproduct") {
            unset($this->extproductid[$key]);
            unset($this->extproductname[$key]);
            unset($this->extproductgenaric[$key]);
            unset($this->extproductmanufacture[$key]);
            unset($this->extproductcgst[$key]);
            unset($this->extproductcgstamt[$key]);
            unset($this->extproductsgst[$key]);
            unset($this->extproductsgstamt[$key]);
            unset($this->extproductprice[$key]);
            unset($this->extproductqunatity[$key]);
            unset($this->extproducttotal[$key]);
            unset($this->extproductcode[$key]);
            unset($this->extproducthsn[$key]);
            unset($this->extproductstock[$key]);
        }

        $this->totalcalculation();
        $this->updateignoreidfunc();
    }

    public function updatedQuery()
    {
        $this->issupplierselected = false;
        $this->suppliers = Supplier::where(function ($query) {
            $query->where('company_person_name', 'like', '%' . $this->query . '%')
                ->orWhere('company_name', 'like', '%' . $this->query . '%')
                ->orWhere('contact_mobile_no', 'like', '%' . $this->query . '%')
                ->orWhere('contact_phone_no', 'like', '%' . $this->query . '%')
                ->orWhere('email', 'like', '%' . $this->query . '%');
        })
            ->where('is_pharmacy', true)
            ->get()
            ->toArray();
        $this->note = null;
    }

    public function formreset()
    {
        $this->query = null;
        $this->supplier_name = null;
        $this->purchase_date = Carbon::today()->format('Y-m-d');
        $this->mobile_number = null;
        $this->contact_name = null;
        $this->note = null;
        $this->issupplierselected = false;
        $this->tableformreset();
    }

    public function tableformreset()
    {
        $this->stocklessproductid = [];
        $this->abt2beproductid = [];
        $this->stocklessproductname = $this->stocklessproductprice =
        $this->stocklessproductqunatity = $this->stocklessproducttotal =
        $this->abt2beproductname = $this->abt2beproductprice =
        $this->abt2beproductqunatity = $this->abt2beproducttotal =
        $this->stocklessproductname = $this->stocklessproductgenaric = $this->abt2beminstock =
        $this->abt2beproductgenaric = $this->abt2beproductmanufacture = $this->stocklessproductcgstamt =
        $this->stocklessproductcgst = $this->stocklessproductsgstamt = $this->stocklessproductsgst =
        $this->abt2beproductcgstamt = $this->abt2beproductcgst = $this->abt2beproductsgstamt =
        $this->abt2beproductsgst = $this->taxamt = $this->taxableamt = null;
    }

    public function store()
    {
        $validate = $this->validate();
        $user = $this->currentuser();

        try {
            if (sizeof($this->stocklessproductid) == 0 && sizeof($this->abt2beproductid) == 0 && sizeof($this->extproductid) == 0) {
                $this->toaster('warning', 'No Itmes Added');
            } else {
                $whole = floor($this->grandtotal);
                $fraction = $this->grandtotal - $whole;
                if ($fraction > 0.49) {
                    $data['round_off'] = 1 - $fraction;
                    $data['grand_total'] = $whole + 1;
                } else {
                    $data['round_off'] = $fraction;
                    $data['grand_total'] = $whole;
                }

                if ($this->purchaseplanid) {
                    DB::beginTransaction();
                    $pharmacypurchaseplan = Pharmpurchaseplan::find($this->purchaseplanid);
                    $pharmacypurchaseplan->deleteitems();
                    $pharmacypurchaseplan->update([
                        'planning_date' => $this->purchase_date,
                        'grand_total' =>  $data['grand_total'],
                        'round_off' => $data['round_off'],
                        'taxamt' => $this->taxamt,
                        'taxableamt' => $this->grandtotal - $this->taxamt,
                        'cgst' => collect($this->stocklessproductcgstamt)->sum() +
                        collect($this->abt2beproductcgstamt)->sum() +
                        collect($this->extproductcgstamt)->sum(),
                        'sgst' => collect($this->stocklessproductsgstamt)->sum() +
                        collect($this->abt2beproductsgstamt)->sum() +
                        collect($this->extproductsgstamt)->sum(),
                        'note' => $this->note,
                    ]);
                    $user->pharmpurchaseplanupdatable()->save($pharmacypurchaseplan);

                    $this->createitems($pharmacypurchaseplan);

                    Helper::trackmessage($user, $pharmacypurchaseplan, 'pharmacy_purhcaseplanning_edit', session()->getId(), 'WEB', 'Purchase Planning Created');
                    DB::commit();
                    $this->toaster('success', 'Purhcase Plan Updated!!');
                    $this->formreset();

                    return redirect()->route('pharmacy.purchaseplanning');
                } else {
                    DB::beginTransaction();

                    $pharmacypurchaseplan = $user->pharmpurchaseplancreatable()->create([
                        'supplier_id' => $this->supplier->id,
                        'supplier_companyname' => $this->supplier->company_name,
                        'supplier_mobile_no' => $this->supplier->contact_mobile_no,
                        'supplier_contact_name' => $this->supplier->company_person_name,
                        'planning_date' => $this->purchase_date,
                        'grand_total' =>  $data['grand_total'],
                        'round_off' => $data['round_off'],
                        'taxamt' => $this->taxamt,
                        'taxableamt' => $this->grandtotal - $this->taxamt,
                        'cgst' => collect($this->stocklessproductcgstamt)->sum() +
                        collect($this->abt2beproductcgstamt)->sum() +
                        collect($this->extproductcgstamt)->sum(),
                        'sgst' => collect($this->stocklessproductsgstamt)->sum() +
                        collect($this->abt2beproductsgstamt)->sum() +
                        collect($this->extproductsgstamt)->sum(),
                        'note' => $this->note,
                    ]);

                    $this->createitems($pharmacypurchaseplan);

                    Helper::trackmessage($user, $pharmacypurchaseplan, 'pharmacy_purhcaseplanning_createoredit', session()->getId(), 'WEB', 'Purchase Planning Created');
                    DB::commit();
                    $this->toaster('success', 'Purhcase Plan Created!!');
                    $this->formreset();
                    return redirect()->route('pharmacy.purchaseplanning');
                }
            }

        } catch (Exception $e) {
            $this->exceptionerror($user, 'pharmacy_purhcaseplanning_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'pharmacy_purhcaseplanning_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'pharmacy_purhcaseplanning_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function productselected($product_id)
    {
        $product = Pharmacyproduct::find($product_id);
        $this->extproductid[] = $product->id;
        $this->extproductname[] = $product->name;
        $this->extproductgenaric[] = $product->pharmacygenaricname?->name;
        $this->extproductmanufacture[] = $product->pharmacymanufacturename?->name;
        $this->extproductcgst[] = $product->cgst;
        $this->extproductcgstamt[] = 0;
        $this->extproductsgst[] = $product->sgst;
        $this->extproductsgstamt[] = 0;
        $this->extproductprice[] = $product->purchase_rate ? $product->purchase_rate : '';
        $this->extproductqunatity[] = 0;
        $this->extproducttotal[] = 0;
        $this->extproductcode[] = $product->product_code;
        $this->extproducthsn[] = $product->hsn;
        $this->extproductstock[] = $product->stock;
        $this->dispatch('cleanupfields');
        $this->updateignoreidfunc();
    }

    public function createitems($pharmacypurchaseplan)
    {
        if (sizeof($this->stocklessproductid) != 0) {
            foreach ($this->stocklessproductid as $key => $value) {
                Pharmpurchaseplanitem::create([
                    'pharmpurchaseplan_id' => $pharmacypurchaseplan->id,
                    'pharmacyproduct_id' => $this->stocklessproductid[$key],
                    'pharmacyproduct_name' => $this->stocklessproductname[$key],

                    'genaric_name' => $this->stocklessproductgenaric[$key],
                    'manufacture_name' => $this->stocklessproductmanufacture[$key],

                    'pharmacyproduct_code' => $this->stocklessproductcode[$key],
                    'pharmacyproduct_hsn' => $this->stocklessproducthsn[$key],

                    'sgst' => $this->stocklessproductsgst[$key],
                    'sgst_amt' => $this->stocklessproductcgstamt[$key],
                    'cgst' => $this->stocklessproductcgst[$key],
                    'cgst_amt' => $this->stocklessproductsgstamt[$key],

                    'price' => $this->stocklessproductprice[$key],
                    'quantity' => $this->stocklessproductqunatity[$key],
                    'type' => 1,
                    'total' => $this->stocklessproducttotal[$key],
                ]);
            }
        }

        if (sizeof($this->abt2beproductid) != 0) {
            foreach ($this->abt2beproductid as $key => $value) {
                Pharmpurchaseplanitem::create([
                    'pharmpurchaseplan_id' => $pharmacypurchaseplan->id,
                    'pharmacyproduct_id' => $this->abt2beproductid[$key],
                    'pharmacyproduct_name' => $this->abt2beproductname[$key],

                    'genaric_name' => $this->abt2beproductgenaric[$key],
                    'manufacture_name' => $this->abt2beproductmanufacture[$key],

                    'pharmacyproduct_code' => $this->abt2beproductcode[$key],
                    'pharmacyproduct_hsn' => $this->abt2beproducthsn[$key],

                    'sgst' => $this->abt2beproductsgst[$key],
                    'sgst_amt' => $this->abt2beproductsgstamt[$key],
                    'cgst' => $this->abt2beproductcgst[$key],
                    'cgst_amt' => $this->abt2beproductcgstamt[$key],

                    'price' => $this->abt2beproductprice[$key],
                    'quantity' => $this->abt2beproductqunatity[$key],
                    'type' => 2,
                    'total' => $this->abt2beproducttotal[$key],
                ]);
            }
        }

        if (sizeof($this->extproductid) != 0) {
            foreach ($this->extproductid as $key => $value) {
                Pharmpurchaseplanitem::create([
                    'pharmpurchaseplan_id' => $pharmacypurchaseplan->id,
                    'pharmacyproduct_id' => $this->extproductid[$key],
                    'pharmacyproduct_name' => $this->extproductname[$key],

                    'genaric_name' => $this->extproductgenaric[$key],
                    'manufacture_name' => $this->extproductmanufacture[$key],

                    'pharmacyproduct_code' => $this->extproductcode[$key],
                    'pharmacyproduct_hsn' => $this->extproducthsn[$key],

                    'sgst' => $this->extproductsgst[$key],
                    'sgst_amt' => $this->extproductsgstamt[$key],
                    'cgst' => $this->extproductcgst[$key],
                    'cgst_amt' => $this->extproductcgstamt[$key],

                    'price' => $this->extproductprice[$key],
                    'quantity' => $this->extproductqunatity[$key],
                    'type' => 3,
                    'total' => $this->extproducttotal[$key],
                ]);
            }
        }
    }

    protected function updateignoreidfunc()
    {
        $ar1 = collect($this->abt2beproductid)->toArray();
        $ar2 = collect($this->stocklessproductid)->toArray();
        $ar3 = collect($this->extproductid)->toArray();
        $c = array_merge($ar1, $ar2);
        $c2 = array_merge($ar3, $c);
        $this->dispatch('updateignoreids', $c2);
    }

    public function render()
    {
        return view('livewire.pharmacy.purchase.purchaseplanning.purchaseplanningcreateoreditlivewire');
    }
}
