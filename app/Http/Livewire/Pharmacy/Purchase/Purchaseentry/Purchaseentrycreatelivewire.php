<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseentry;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentry;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorderitem;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Product\Pharmproductinventory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Purchaseentrycreatelivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $po, $polist, $highlightIndex = 0,
    $isposelected = false, $supplier, $selectedpo, $poitems = [], $extproductid = [],
    $productid, $productname, $productqty, $productuuid, $inward,
    $supplier_id, $batch, $expiry_date, $quantity, $note, $ignoreids = [];

    public $taxableamt, $taxamt, $cgst, $sgst, $grandtotal;

    protected $listeners = ['supplierselected', 'productselected'];

    protected function rules()
    {
        return [
            'po' => 'required',
        ];
    }

    public function resetData()
    {
        $this->po = '';
        $this->polist = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->polist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->polist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectPo()
    {
        $po = $this->polist[$this->highlightIndex] ?? null;
        if ($po) {
            $this->selecthispo($this->polist[$this->highlightIndex]['id']);
        }
    }

    public function selecthispo($poid)
    {
        $this->isposelected = true;
        $this->selectedpo = Pharmpurchaseorder::find($poid);
        $this->po = $this->selectedpo->uniqid;
        $this->poitems = $this->selectedpo->poitems;
        $this->ignoreids = [];
        foreach ($this->poitems as $value) {
            $this->ignoreids[] = $value->pharmacyproduct_id;
            $this->inward[$value->id] = [];
        }
        $this->supplier = $this->selectedpo->supplier;
    }

    public function productselected($product_id)
    {
        $product = Pharmacyproduct::find($product_id);
        $uuid = $product->uuid;
        $this->extproductid[$uuid] = [
            $this->productid[$uuid] = $product->id,
            $this->productname[$uuid] = $product->name,
            $this->productqty[$uuid] = $product->stock,
            $this->productuuid[$uuid] = $uuid,
        ];
        $this->inward[$uuid] = [];
        $this->ignoreids[] = $product_id;
        $this->dispatch('cleanupfields');
        $this->dispatch('updateignoreids', $this->ignoreids);
    }

    public function updatedPo()
    {
        $this->isposelected = false;
        if ($this->supplier_id) {
            $this->polist = Pharmpurchaseorder::where('supplier_id', $this->supplier_id)
                ->where('po_status', false)
                ->where(fn($query) => ($this->po) ? $query->where(function ($po) {
                    $po->where('uniqid', 'like', '%' . $this->po . '%')
                        ->orWhere('supplier_companyname', 'like', '%' . $this->po . '%')
                        ->orWhere('supplier_mobile_no', 'like', '%' . $this->po . '%')
                        ->orWhere('supplier_contact_name', 'like', '%' . $this->po . '%');
                }) : '')
                ->latest()
                ->get()
                ->toArray();
        } else {
            $this->polist = [];
        }

    }

    public function addcol($key)
    {
        $pharmproduct = Pharmpurchaseorderitem::find($key)->pharmacyproduct;
        array_push($this->inward[$key], [
            'batch' => '',
            'expiry_date' => '',
            'sgst' => $pharmproduct->sgst,
            'sgst_amount' => '',
            'cgst' => $pharmproduct->cgst,
            'cgst_amount' => '',
            'quantity' => '',
            'mrp' => $pharmproduct->purchase_rate,
            'selling_price' => $pharmproduct->mrp,
            'product_id' => $pharmproduct->id,
            'pharmpurchaseorderitem_id' => $key,
            'total' => 0,
        ]);
    }

    public function addextcol($productuuid)
    {
        $product = Pharmacyproduct::where('uuid', $productuuid)->first();
        array_push($this->inward[$productuuid], [
            'batch' => '',
            'expiry_date' => '',
            'sgst' => $product->sgst,
            'sgst_amount' => '',
            'cgst' => $product->cgst,
            'cgst_amount' => '',
            'total' => 0,
            'quantity' => '',
            'mrp' => $product->purchase_rate,
            'selling_price' => $product->mrp,
            'product_id' => $product->id,
            'pharmpurchaseorderitem_id' => '',
        ]);
    }

    public function productlivevalidation($mainkey, $subkey)
    {
        $total = (is_numeric($this->inward[$mainkey][$subkey]['quantity']) ? $this->inward[$mainkey][$subkey]['quantity'] : 0)
             * (is_numeric($this->inward[$mainkey][$subkey]['mrp']) ? $this->inward[$mainkey][$subkey]['mrp'] : 0);

        $this->inward[$mainkey][$subkey]['cgst_amount'] = ($this->inward[$mainkey][$subkey]['cgst'] / 100) * $total;
        $this->inward[$mainkey][$subkey]['sgst_amount'] = ($this->inward[$mainkey][$subkey]['sgst'] / 100) * $total;
        $this->inward[$mainkey][$subkey]['total'] = $total + $this->inward[$mainkey][$subkey]['cgst_amount'] + $this->inward[$mainkey][$subkey]['sgst_amount'];
        $this->globalcalculation();
    }

    protected function globalcalculation()
    {
        $taxableamt = [];
        $cgst = [];
        $sgst = [];
        foreach ($this->poitems as $firstvalue) {
            if ($this->inward[$firstvalue->id] != []) {
                foreach ($this->inward[$firstvalue->id] as $subkey => $secondvalue) {
                    $total = (is_numeric($this->inward[$firstvalue->id][$subkey]['quantity']) ? $this->inward[$firstvalue->id][$subkey]['quantity'] : 0)
                         * (is_numeric($this->inward[$firstvalue->id][$subkey]['mrp']) ? $this->inward[$firstvalue->id][$subkey]['mrp'] : 0);
                    $percgst = ($this->inward[$firstvalue->id][$subkey]['cgst'] / 100) * $total;
                    $persgst = ($this->inward[$firstvalue->id][$subkey]['sgst'] / 100) * $total;

                    $taxableamt[] = $total;
                    $cgst[] = $percgst;
                    $sgst[] = $persgst;
                }
            }
        }
        foreach ($this->extproductid as $uuidkey => $value) {
            if ($this->inward[$uuidkey] != []) {
                foreach ($this->inward[$uuidkey] as $subkey => $thirdvalue) {
                    $total = (is_numeric($this->inward[$uuidkey][$subkey]['quantity']) ? $this->inward[$uuidkey][$subkey]['quantity'] : 0)
                         * (is_numeric($this->inward[$uuidkey][$subkey]['mrp']) ? $this->inward[$uuidkey][$subkey]['mrp'] : 0);
                    $percgst = ($this->inward[$uuidkey][$subkey]['cgst'] / 100) * $total;
                    $persgst = ($this->inward[$uuidkey][$subkey]['sgst'] / 100) * $total;

                    $taxableamt[] = $total;
                    $cgst[] = $percgst;
                    $sgst[] = $persgst;
                }
            }
        }

        $this->taxableamt = collect($taxableamt)->sum();
        $this->cgst = collect($cgst)->sum();
        $this->sgst = collect($sgst)->sum();
        $grandtotal = $this->taxableamt + $this->cgst + $this->sgst;
        $this->taxamt = $this->cgst + $this->sgst;

        $whole = floor($grandtotal);
        $fraction = $grandtotal - $whole;
        if ($fraction > 0.49) {
            $this->grandtotal = $whole + 1;
        } else {
            $this->grandtotal = $whole;
        }
    }

    public function subcol($mainkey, $subkey)
    {
        unset($this->inward[$mainkey][$subkey]['batch']);
        unset($this->inward[$mainkey][$subkey]['expiry_date']);
        unset($this->inward[$mainkey][$subkey]['sgst']);
        unset($this->inward[$mainkey][$subkey]['sgst_amount']);
        unset($this->inward[$mainkey][$subkey]['cgst']);
        unset($this->inward[$mainkey][$subkey]['cgst_amount']);
        unset($this->inward[$mainkey][$subkey]['total']);
        unset($this->inward[$mainkey][$subkey]['quantity']);
        unset($this->inward[$mainkey][$subkey]['mrp']);
        unset($this->inward[$mainkey][$subkey]['selling_price']);
        unset($this->inward[$mainkey][$subkey]['product_id']);
        unset($this->inward[$mainkey][$subkey]['pharmpurchaseorderitem_id']);
        unset($this->inward[$mainkey][$subkey]);
    }

    public function clearallextcol($mainkey)
    {
        unset($this->inward[$mainkey]);
    }

    public function clearallcol($mainkey)
    {
        $this->inward[$mainkey] = [];
    }

    public function deleteext($key)
    {
        unset($this->extproductid[$key]);
        $this->ignoreids = [];
        foreach ($this->selectedpo->poitems as $value) {
            $this->ignoreids[] = $value->pharmacyproduct_id;
        }
        if (count($this->extproductid) > 0) {
            foreach ($this->extproductid as $uuidkey => $valuetwo) {
                if ($this->inward[$uuidkey] != []) {
                    $totalq = [];
                    foreach ($this->inward[$uuidkey] as $subkey => $thirdvalue) {
                        $this->ignoreids[] = $this->inward[$uuidkey][$subkey]['product_id'];
                    }
                }
            }
        }
        $this->dispatch('updateignoreids', $this->ignoreids);
    }

    public function store()
    {
        $validate = $this->validate([
            'inward.*.*.batch' => 'required|string|min:1',
            'inward.*.*.expiry_date' => 'required|date|after:' . Carbon::today(),
            'inward.*.*.quantity' => 'required|numeric|min:1',
            'inward.*.*.mrp' => 'required|numeric|min:1',
            'inward.*.*.selling_price' => 'required|numeric|min:1',
        ], [
            'inward.*.*.batch.required' => "Required",
            'inward.*.*.batch.string' => "Invalid",
            'inward.*.*.batch.min' => "Required",

            'inward.*.*.expiry_date.required' => "Required",
            'inward.*.*.expiry_date.date' => "Invalid",
            'inward.*.*.expiry_date.after' => "Invalid",

            'inward.*.*.quantity.required' => "Required",
            'inward.*.*.quantity.numeric' => "Invalid",
            'inward.*.*.quantity.min' => "Invalid",

            'inward.*.*.mrp.required' => "Required",
            'inward.*.*.mrp.numeric' => "Invalid",
            'inward.*.*.mrp.min' => "Invalid",

            'inward.*.*.selling_price.required' => "Required",
            'inward.*.*.selling_price.numeric' => "Invalid",
            'inward.*.*.selling_price.min' => "Invalid",
        ]);

        if (count($validate) === 0) {
            $this->toaster('warning', 'No Item Added');
        } else {
            try {
                DB::beginTransaction();
                $user = $this->currentuser();
                $whole = floor($this->grandtotal);
                $fraction = $this->grandtotal - $whole;
                if ($fraction > 0.49) {
                    $data['round_off'] = 1 - $fraction;
                    $data['grand_total'] = $whole + 1;
                } else {
                    $data['round_off'] = $fraction;
                    $data['grand_total'] = $whole;
                }

                $pharmpurchaseentry = $user->pharmpurchaseentrycreatable()->create([
                    'pharmpurchaseorder_id' => $this->selectedpo->id,
                    'supplier_id' => $this->selectedpo->supplier_id,
                    'purchaseorder_uniqid' => $this->selectedpo->uniqid,
                    'grand_total' => $data['grand_total'],
                    'round_off' => $data['round_off'],
                    'taxamt' => $this->taxamt,
                    'taxableamt' => $this->taxableamt,
                    'cgst' => $this->cgst,
                    'sgst' => $this->sgst,
                    'note' => $this->note,
                ]);

                $user->supplierstatementcreatable()->create([
                    'supplier_id' => $this->selectedpo->supplier_id,
                    'credit' => $data['grand_total'],
                    'debit' => 0,
                    'note' => 'Purchase Entry',
                    'entity_type' => 3,
                    'transaction_type' => 'C',
                    'statement_ref_id' => $pharmpurchaseentry->uniqid,
                ])
                    ->statementable()
                    ->associate($pharmpurchaseentry)
                    ->save();

                // Hospital Statement
                $user->hospitalstatementcreatable()->make([
                    'user_type' => 3,
                    'credit' => $data['grand_total'],
                    'debit' => 0,
                    'note' => 'Purchase Entry',
                    'entity_type' => 3,
                    'transaction_type' => 'C',
                    'statement_ref_id' => $pharmpurchaseentry->uniqid,
                ])
                    ->userable()
                    ->associate($pharmpurchaseentry->supplier)
                    ->hstatementable()
                    ->associate($pharmpurchaseentry)
                    ->save();
                $postatus = 0;
                foreach ($this->poitems as $firstvalue) {
                    if ($this->inward[$firstvalue->id] != []) {
                        $totalq = [];
                        foreach ($this->inward[$firstvalue->id] as $subkey => $secondvalue) {
                            $totalq[] = $this->inward[$firstvalue->id][$subkey]['quantity'];
                            $pharmpurchaseentryitem = Pharmpurchaseentryitem::create([
                                'supplier_id' => $this->supplier->id,
                                'pharmpurchaseentry_id' => $pharmpurchaseentry->id,
                                'batch' => $this->inward[$firstvalue->id][$subkey]['batch'],
                                'expiry_date' => $this->inward[$firstvalue->id][$subkey]['expiry_date'],
                                'pharmacyproduct_id' => $this->inward[$firstvalue->id][$subkey]['product_id'],
                                'purchase_price' => $this->inward[$firstvalue->id][$subkey]['mrp'],
                                'quantity' => $this->inward[$firstvalue->id][$subkey]['quantity'],
                                'received_quantity' => $this->inward[$firstvalue->id][$subkey]['quantity'],
                                'selling_price' => $this->inward[$firstvalue->id][$subkey]['selling_price'],
                                'pharmpurchaseorderitem_id' => $this->inward[$firstvalue->id][$subkey]['pharmpurchaseorderitem_id'],

                                'sgst' => $this->inward[$firstvalue->id][$subkey]['sgst'],
                                'sgst_amt' => $this->inward[$firstvalue->id][$subkey]['sgst_amount'],
                                'cgst' => $this->inward[$firstvalue->id][$subkey]['cgst'],
                                'cgst_amt' => $this->inward[$firstvalue->id][$subkey]['cgst_amount'],
                                'total' => $this->inward[$firstvalue->id][$subkey]['total'],
                            ]);

                            Pharmproductinventory::create([
                                'pharmpurchaseentryitem_id' => $pharmpurchaseentryitem->id,
                                'pharmacyproduct_id' => $this->inward[$firstvalue->id][$subkey]['product_id'],
                                'quantity' => $this->inward[$firstvalue->id][$subkey]['quantity'],
                            ]);
                        }
                        $poitem = Pharmpurchaseorderitem::find($firstvalue->id);
                        $poitem->received_quantity = $poitem->received_quantity + collect($totalq)->sum();
                        $poitem->save();

                        $product = $poitem->pharmacyproduct;
                        $product->stock = $product->stock + collect($totalq)->sum();
                        $product->save();
                    }
                }

                $this->postatuslogic($this->poitems);

                if (count($this->extproductid) > 0) {
                    foreach ($this->extproductid as $uuidkey => $value) {
                        if ($this->inward[$uuidkey] != []) {
                            $totalq = [];
                            foreach ($this->inward[$uuidkey] as $subkey => $thirdvalue) {
                                $totalq[] = $this->inward[$uuidkey][$subkey]['quantity'];
                                Pharmpurchaseentryitem::create([
                                    'supplier_id' => $this->supplier->id,
                                    'pharmpurchaseentry_id' => $pharmpurchaseentry->id,
                                    'batch' => $this->inward[$uuidkey][$subkey]['batch'],
                                    'expiry_date' => $this->inward[$uuidkey][$subkey]['expiry_date'],
                                    'pharmacyproduct_id' => $this->inward[$uuidkey][$subkey]['product_id'],
                                    'purchase_price' => $this->inward[$uuidkey][$subkey]['mrp'],
                                    'quantity' => $this->inward[$uuidkey][$subkey]['quantity'],
                                    'received_quantity' => $this->inward[$uuidkey][$subkey]['quantity'],
                                    'selling_price' => $this->inward[$uuidkey][$subkey]['selling_price'],

                                    'sgst' => $this->inward[$uuidkey][$subkey]['sgst'],
                                    'sgst_amt' => $this->inward[$uuidkey][$subkey]['sgst_amount'],
                                    'cgst' => $this->inward[$uuidkey][$subkey]['cgst'],
                                    'cgst_amt' => $this->inward[$uuidkey][$subkey]['cgst_amount'],
                                    'total' => $this->inward[$uuidkey][$subkey]['total'],
                                ]);
                            }
                            $poitem = Pharmpurchaseorderitem::find($firstvalue->id);
                            $poitem->received_quantity = $poitem->received_quantity + collect($totalq)->sum();
                            $poitem->save();

                            $product = $poitem->pharmacyproduct;
                            $product->stock = $product->stock + collect($totalq)->sum();
                            $product->save();
                        }
                    }
                }

                Helper::trackmessage($user, $pharmpurchaseentry, 'pharmacy_purhcaseplanning_createoredit', session()->getId(), 'WEB', 'Purchase Planning Created');
                DB::commit();
                $this->toaster('success', 'Purhcase Entry Created!!');
                $this->formreset();
                return redirect()->route('pharmacy.pruchasecreate');

            } catch (Exception $e) {
                $this->exceptionerror($user, 'purchase_entry', 'error_one : ' . $e->getMessage());
            } catch (QueryException $e) {
                $this->exceptionerror($user, 'purchase_entry', 'error_two : ' . $e->getMessage());
            } catch (PDOException $e) {
                $this->exceptionerror($user, 'purchase_entry', 'error_three : ' . $e->getMessage());
            }
        }
    }

    public function additionalitems()
    {
        $pharmpurchaseentry = Pharmpurchaseentry::where('pharmpurchaseorder_id', $this->selectedpo->id)
            ->first();
        if ($pharmpurchaseentry) {
            return $pharmpurchaseentry;
        } else {
            return null;
        }
    }

    public function supplierselected($supplier)
    {
        if ($supplier) {
            $this->supplier_id = $supplier;
            $this->polist = Pharmpurchaseorder::where('supplier_id', $this->supplier_id)
                ->where('po_status', false)
                ->latest()
                ->get()
                ->toArray();
            $this->isposelected = false;
        } else {
            $this->formreset();
            $this->resetData();
            $this->isposelected = false;
        }
    }

    public function formreset()
    {
        $this->resetData();
        $this->poitems = [];
        $this->inward = [];
        $this->isposelected = false;
        $this->selectedpo = null;
        $this->supplier = null;
    }

    public function postatuslogic($poitems)
    {
        $postatus = 0;
        foreach ($poitems as $value) {
            $thispo = Pharmpurchaseorderitem::find($value->id);
            if ($thispo) {
                if ($thispo->received_quantity >= $thispo->quantity) {
                    $postatus += 1;
                }
            }
        }

        if (count($poitems) == $postatus) {
            Pharmpurchaseorder::find($poitems[0]->pharmpurchaseorder_id)
                ->update([
                    'po_status' => true,
                ]);
        }
    }

    public function render()
    {
        return view('livewire.pharmacy.purchase.purchaseentry.purchaseentrycreatelivewire');
    }
}
