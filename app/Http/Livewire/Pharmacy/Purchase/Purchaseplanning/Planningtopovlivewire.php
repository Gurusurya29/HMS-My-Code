<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseplanning;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorderitem;
use App\Models\Pharmacy\Purchase\Purchaseplanning\Pharmpurchaseplan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Planningtopovlivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $pharmplanningid;

    public function mount($pharmplanningid)
    {
        $this->pharmplanningid = $pharmplanningid;
    }

    public function movetopo()
    {
        $pharmacypurchaseplan = Pharmpurchaseplan::find($this->pharmplanningid);
        $user = $this->currentuser();
        try {
            $pharmpurchaseorder = $user->pharmpurchaseordercreatable()->create([
                'supplier_id' => $pharmacypurchaseplan->supplier_id,
                'supplier_companyname' => $pharmacypurchaseplan->supplier_companyname,
                'supplier_mobile_no' => $pharmacypurchaseplan->supplier_mobile_no,
                'supplier_contact_name' => $pharmacypurchaseplan->supplier_contact_name,
                'planning_date' => $pharmacypurchaseplan->planning_date,
                'grand_total' => $pharmacypurchaseplan->grand_total,
                'round_off' => $pharmacypurchaseplan->round_off,
                'taxamt' => $pharmacypurchaseplan->taxamt,
                'taxableamt' => $pharmacypurchaseplan->taxableamt,
                'note' => $pharmacypurchaseplan->note,
                'cgst' => $pharmacypurchaseplan->cgst,
                'sgst' => $pharmacypurchaseplan->sgst,
            ]);

            foreach ($pharmacypurchaseplan->outofstock() as $key => $value) {
                $this->createitems($pharmpurchaseorder->id, $value);

            }
            foreach ($pharmacypurchaseplan->abt2beoutofstock() as $key => $value) {
                $this->createitems($pharmpurchaseorder->id, $value);
            }
            foreach ($pharmacypurchaseplan->extstock() as $key => $value) {
                $this->createitems($pharmpurchaseorder->id, $value);
            }

            $pharmacypurchaseplan->update([
                'po_status' => true,
            ]);
            $pharmacypurchaseplan->save();

            Helper::trackmessage($user, $pharmpurchaseorder, 'pharmacy_purhcaseorder_create', session()->getId(), 'WEB', 'Purchase Order Created');
            DB::commit();
            $this->toaster('success', 'Purhcase Order Created!!');
            $this->dispatch('refreshthisparent');
            $this->formreset();

        } catch (Exception $e) {
            $this->exceptionerror($user, 'pharmacy_purhcaseorder_create', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'pharmacy_purhcaseorder_create', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'pharmacy_purhcaseorder_create', 'error_three : ' . $e->getMessage());
        }
    }

    public function createitems($pharmpurchaseorderid, $value)
    {
        Pharmpurchaseorderitem::create([
            'pharmpurchaseorder_id' => $pharmpurchaseorderid,
            'pharmacyproduct_id' => $value->pharmacyproduct_id,
            'pharmacyproduct_name' => $value->pharmacyproduct_name,
            'pharmacyproduct_code' => $value->pharmacyproduct_code,
            'pharmacyproduct_hsn' => $value->pharmacyproduct_hsn,
            'genaric_name' => $value->genaric_name,
            'manufacture_name' => $value->manufacture_name,
            'sgst' => $value->sgst,
            'sgst_amt' => $value->sgst_amt,
            'cgst' => $value->cgst,
            'cgst_amt' => $value->cgst_amt,
            'price' => $value->price,
            'quantity' => $value->quantity,
            'total' => $value->total,
        ]);
    }

    public function formreset()
    {}

    public function render()
    {
        return view('livewire.pharmacy.purchase.purchaseplanning.planningtopovlivewire');
    }
}
