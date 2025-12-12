<?php

namespace App\Http\Livewire\Pharmacy\Sales\Salesreturn;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentryitem;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturnitem;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Product\Pharmproductinventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Livewire\Component;

class Salesreturncreatelivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $patientid, $saleid, $return_note, $debit_amount, $batch_verified;
    public $sale, $salelist, $highlightIndex, $issaleselected = false;

    public $salesproductid = [], $salesbatch = [], $salesexpiry_date = [], $returnquantity = [], $salesselling_price = [],
    $salesproductname = [], $is_selected = [], $soldquantity = [], $salesentryitemid = [], $eligibleto_select = [],
    $returnqty = [];

    protected $listeners = ['patientselected'];

    protected $rules = [
        'return_note' => 'required',
        'debit_amount' => 'required|integer',
        'batch_verified' => 'required|min:1',
    ];

    protected $messages = [
        'batch_verified.required' => 'Please verify the batch numbers',
        'debit_amount.integer' => 'Enter a valid amount',
        'batch_verified.min' => 'Please verify the batch numbers',
    ];

    public function mount($type = null)
    {
        if ($type) {
            $this->type = $type;
        }
        $this->resetData();
    }

    public function resetData()
    {
        $this->sale = '';
        $this->salelist = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->salelist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->salelist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function updatedSale()
    {
        $this->issaleselected = false;
        $this->salelist = Pharmsalesentry::where('patient_id', $this->patientid)
            ->where(function ($sale) {
                $sale->where('uniqid', 'like', '%' . $this->sale . '%');
            })
            ->latest()
            ->get();
    }

    public function selectSale()
    {
        $sale = $this->salelist[$this->highlightIndex] ?? null;
        if ($sale) {
            $higlightsale = $this->salelist[$this->highlightIndex];
            $this->selecthissale($higlightsale->id, $higlightsale->uniqid);
        }
    }

    public function selecthissale($id, $uniqid)
    {
        $this->issaleselected = true;
        $this->sale = $uniqid;
        $this->saleid = $id;
        $this->loadsalesitems();
    }

    public function loadsalesitems()
    {
        $this->formreset();
        $selectedsalesitems = Pharmsalesentryitem::where('pharmsalesentry_id', $this->saleid)
            ->get();
        foreach ($selectedsalesitems as $value) {
            $this->salesentryitemid[] = $value->id;
            $this->salesproductid[] = $value->pharmacyproduct_id;
            $this->salesproductname[] = $value->pharmproduct->name;
            $this->salesbatch[] = $value->batch;
            $this->salesexpiry_date[] = $value->expiry_date;
            $this->returnquantity[] = $value->quantity - $value->return_quantity;
            $this->soldquantity[] = $value->quantity;
            $this->salesselling_price[] = $value->selling_price;
            $this->returnqty[] = $value->return_quantity;
            $this->eligibleto_select[] = $value->return_quantity == $value->quantity ? false : true;
            $this->is_selected[] = false;
        }
    }

    public function formreset()
    {
        $this->salesentryitemid = [];
        $this->salesproductid = [];
        $this->salesproductname = [];
        $this->salesbatch = [];
        $this->salesexpiry_date = [];
        $this->returnquantity = [];
        $this->soldquantity = [];
        $this->salesselling_price = [];
        $this->eligibleto_select = [];
        $this->returnqty = [];
        $this->is_selected = [];
    }

    public function patientselected($id)
    {
        $this->patientid = $id;
    }

    public function createsalesreturn()
    {
        $selected = collect($this->is_selected)->sum();
        if ($selected === 0) {
            $this->toaster('warning', 'No Items Selected For Return');
        } else {
            $this->validate();
            $user = $this->currentuser();

            try {
                DB::beginTransaction();
                $pharmacyreturn = $user->pharmsalesreturncreatable()->create([
                    'patient_id' => $this->patientid,
                    'pharmsalesentry_id' => $this->saleid,
                    'return_note' => $this->return_note,
                    'debit_amount' => $this->debit_amount,
                ]);

                // Patient Statement
                $user->patientstatementcreatable()->make([
                    'patient_id' => $this->patientid,
                    'credit' => $this->debit_amount,
                    'debit' => 0,
                    'note' => 'Pharmacy Sales Return',
                    'entity_type' => 3,
                    'transaction_type' => 'C',
                    'statement_ref_id' => $pharmacyreturn->uniqid,
                ])
                    ->statementable()
                    ->associate($pharmacyreturn)
                    ->save();

                // Hospital Statement
                $user->hospitalstatementcreatable()->make([
                    'user_type' => 1,
                    'credit' => $this->debit_amount,
                    'debit' => 0,
                    'note' => 'Pharmacy Sales Return',
                    'transaction_type' => 'C',
                    'statement_ref_id' => $pharmacyreturn->uniqid,
                ])
                    ->userable()
                    ->associate($pharmacyreturn->patient)
                    ->hstatementable()
                    ->associate($pharmacyreturn)
                    ->save();

                foreach ($this->salesproductid as $key => $value) {
                    if ($this->is_selected[$key]) {
                        $this->withValidator(function (Validator $validator) use ($key) {
                            $validator->after(function ($validator) use ($key) {
                                if ($this->returnquantity[$key] == null) {
                                    $validator->errors()->add('returnquantity.' . $key, 'Required');
                                }
                                $qtyvalid = $this->soldquantity[$key] + $this->returnqty[$key];
                                if ($this->returnquantity[$key] > $qtyvalid) {
                                    $validator->errors()->add('returnquantity.' . $key, 'Invalid');
                                }
                            });
                        })->validate();

                        $pharmsalesreturnitem = Pharmsalesreturnitem::create([
                            'pharmacyproduct_id' => $this->salesproductid[$key],
                            'pharmsalesentryitem_id' => $this->salesentryitemid[$key],
                            'return_quantity' => $this->returnquantity[$key],
                            'pharmsalesreturn_id' => $pharmacyreturn->id,
                        ]);

                        Pharmproductinventory::create([
                            'pharmsalesreturnitem_id' => $pharmsalesreturnitem->id,
                            'pharmacyproduct_id' => $this->salesproductid[$key],
                            'quantity' => $this->returnquantity[$key],
                        ]);

                        $pharmsaleentry = Pharmsalesentryitem::find($this->salesentryitemid[$key]);
                        $pharmsaleentry->return_quantity = $pharmsaleentry->return_quantity + $this->returnquantity[$key];
                        $pharmsaleentry->save();

                        $pharmpurchaseentryitem = Pharmpurchaseentryitem::find($pharmsaleentry->pharmpurchaseentryitem_id);
                        $pharmpurchaseentryitem->fromsalereturn_quant = $pharmpurchaseentryitem->fromsalereturn_quant + $this->returnquantity[$key];
                        $pharmpurchaseentryitem->quantity = $pharmpurchaseentryitem->quantity + $this->returnquantity[$key];
                        $pharmpurchaseentryitem->save();

                        $pharmpproduct = Pharmacyproduct::find($this->salesproductid[$key]);
                        $pharmpproduct->stock = $pharmpproduct->stock + $this->returnquantity[$key];
                        $pharmpproduct->save();

                    }
                }
                Helper::trackmessage($user, $pharmacyreturn, 'pharmacy_sales_return', session()->getId(), 'WEB', 'Pharmacy Sales Return Created');
                DB::commit();
                $this->toaster('success', 'Created!!');
                return redirect()->route('pharmacy.salesreturncreate');

            } catch (Exception $e) {
                $this->exceptionerror($this->currentuser(), 'pharmacy_sales_return', 'error_one : ' . $e->getMessage());
            } catch (QueryException $e) {
                $this->exceptionerror($this->currentuser(), 'pharmacy_sales_return', 'error_two : ' . $e->getMessage());
            } catch (PDOException $e) {
                $this->exceptionerror($this->currentuser(), 'pharmacy_sales_return', 'error_three : ' . $e->getMessage());
            }
        }
    }

    public function render()
    {
        return view('livewire.pharmacy.sales.salesreturn.salesreturncreatelivewire');
    }
}
