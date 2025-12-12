<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchasereturn;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Purchase\Purchasereturn\Purchasereturnitem;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Product\Pharmproductinventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Livewire\Component;

class Purchasereturncreatelivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $batch_id, $batchselected = false, $returnitems = [],
    $negotiated_price, $issue_note, $note,
        $supplier_id;

    public $returnproductname = [], $returnbatch = [],
    $returnexpiry_date = [], $returnprice = [], $soldquantity = [],
    $returnquantity = [], $returnproductid = [], $returncurrentqt = [],
    $returnbatchid = [];

    protected $listeners = [
        'batchselected',
        'supplierselected',
    ];

    protected function rules()
    {
        return [
            'negotiated_price' => 'required|integer',
            'issue_note' => 'required',
            'note' => 'nullable',
        ];
    }

    protected $messages = [
        'negotiated_price.integer' => 'Enter a valid amount',
    ];

    public function supplierselected($supplier)
    {
        $this->supplier_id = $supplier;
    }

    public function batchselected(Pharmpurchaseentryitem $batch)
    {
        $key = array_search($batch->pharmacyproduct_id, $this->returnproductid);

        if (is_numeric($key)) {
            $count = 0;
            foreach ($this->returnitems as $returnitemkey => $value) {
                if ($this->returnbatch[$returnitemkey] === $batch->batch) {
                    $this->returnquantity[$returnitemkey] = $this->returnquantity[$returnitemkey];
                    $count += 1;
                }
            }
            if ($count === 0) {
                $this->addprodutlogic($batch);
            }
        } else {
            $this->addprodutlogic($batch);
        }
        $this->dispatch('cleanupfields');
    }

    public function addprodutlogic($batch)
    {
        $this->returnitems[] = [
            $this->returnbatchid[] = $batch->id,
            $this->returnproductname[] = $batch->pharmproduct->name,
            $this->returnproductid[] = $batch->pharmacyproduct_id,
            $this->returnbatch[] = $batch->batch,
            $this->returnexpiry_date[] = $batch->expiry_date,
            $this->returnprice[] = $batch->purchase_price,
            $this->soldquantity[] = $batch->saled_quantity,
            $this->returncurrentqt[] = $batch->quantity,
            $this->returnquantity[] = $batch->quantity,
        ];
    }

    public function removeitem($key)
    {
        unset($this->returnitems[$key]);
        unset($this->returnbatchid[$key]);
        unset($this->returnproductname[$key]);
        unset($this->returnproductid[$key]);
        unset($this->returnbatch[$key]);
        unset($this->returnexpiry_date[$key]);
        unset($this->returnprice[$key]);
        unset($this->soldquantity[$key]);
        unset($this->returncurrentqt[$key]);
        unset($this->returnquantity[$key]);
        $this->dispatch('cleanupfields');
    }

    public function store()
    {
        $validate = $this->validate();
        try {
            DB::beginTransaction();
            $user = $this->currentuser();
            $pharmpurchasereturn = $user->pharmpurchaseitemreturncreatable()->create([
                'supplier_id' => $this->supplier_id,
                'suppliercmpy_name' => Supplier::find($this->supplier_id)->company_name,

                'note' => $this->note,
                'issue_note' => $this->issue_note,
                'negotiated_price' => $this->negotiated_price,
            ]);

            $user->supplierstatementcreatable()->create([
                'supplier_id' => $this->supplier_id,
                'credit' => 0,
                'debit' => $this->negotiated_price,
                'note' => 'Purchase Return',
                'entity_type' => 3,
                'transaction_type' => 'D',
                'statement_ref_id' => $pharmpurchasereturn->uniqid,
            ])
                ->statementable()
                ->associate($pharmpurchasereturn)
                ->save();

            // Hospital Statement
            $user->hospitalstatementcreatable()->make([
                'user_type' => 3,
                'credit' => 0,
                'debit' => $this->negotiated_price,
                'note' => 'Purchase Return',
                'entity_type' => 3,
                'transaction_type' => 'D',
                'statement_ref_id' => $pharmpurchasereturn->uniqid,
            ])
                ->userable()
                ->associate($pharmpurchasereturn->supplier)
                ->hstatementable()
                ->associate($pharmpurchasereturn)
                ->save();

            foreach ($this->returnitems as $key => $value) {
                $this->withValidator(function (Validator $validator) use ($key) {
                    $validator->after(function ($validator) use ($key) {
                        if ($this->returncurrentqt[$key] < $this->returnquantity[$key]) {
                            $validator->errors()->add('returnquantity.' . $key, 'Insufficient Quantity');
                        }
                    });
                })->validate();

                $purchasereturnitem = Purchasereturnitem::create([
                    'pharmpurchasereturn_id' => $pharmpurchasereturn->id,
                    'pharmacyproduct_id' => $this->returnproductid[$key],
                    'return_quantity' => $this->returnquantity[$key],
                    'pharmpurchaseentryitem_id' => $this->returnbatchid[$key],
                ]);

                Pharmproductinventory::create([
                    'purchasereturnitem_id' => $purchasereturnitem->id,
                    'pharmacyproduct_id' => $this->returnproductid[$key],
                    'quantity' => $this->returnquantity[$key],
                ]);

                $product = Pharmacyproduct::find($this->returnproductid[$key]);
                $product->stock = $product->stock - $this->returnquantity[$key];
                $product->save();

                $purchaseentryitems = Pharmpurchaseentryitem::find($this->returnbatchid[$key]);
                $purchaseentryitems->quantity = $purchaseentryitems->quantity - $this->returnquantity[$key];
                $purchaseentryitems->tosupplierreturn_quant = $purchaseentryitems->tosupplierreturn_quant + $this->returnquantity[$key];
                $purchaseentryitems->save();
            }

            Helper::trackmessage($user, $pharmpurchasereturn, 'pharmacy_purchasereturn', session()->getId(), 'WEB', 'Purchase Return Created');
            DB::commit();
            $this->toaster('success', 'Purhcase Return Created!!');
            return redirect()->route('pharmacy.purchasereturncreate');

        } catch (Exception $e) {
            $this->exceptionerror($user, 'purchase_return', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'purchase_return', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'purchase_return', 'error_three : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pharmacy.purchase.purchasereturn.purchasereturncreatelivewire');
    }
}
