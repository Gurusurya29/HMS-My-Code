<?php

namespace App\Http\Livewire\Pharmacy\Purchase\Purchaseorder;

use DB;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;

class Purchaseorderpostatuslivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $po_id, $po_status;

    public function mount($po_id)
    {
        $this->po_id = $po_id;
        $poorder = Pharmpurchaseorder::find($po_id);
        $this->po_status = $poorder->po_status;
    }

    public function updatepostatus()
    {
        $user = $this->currentuser();
        try {
            DB::beginTransaction();
            Pharmpurchaseorder::find($this->po_id)
                ->update([
                    'po_status' => !$this->po_status,
                ]);
            DB::commit();
            $this->po_status = !$this->po_status;
            $this->dispatch('po_statusupdated');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'po_status_update', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'po_status_update', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'po_status_update', 'error_three : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pharmacy.purchase.purchaseorder.purchaseorderpostatuslivewire');
    }
}
