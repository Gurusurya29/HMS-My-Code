<?php

namespace App\Http\Livewire\Laboratory\Scan\Patientlist;

use App\Models\Laboratory\Scan\Scanpatient;
use App\Models\Laboratory\Scan\Scanpatientlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Scandeliverylivewire extends Component
{
    public $uuid, $scanpatient, $delivery_note;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function markdeliverydone(Scanpatientlist $scanpatientlist)
    {
        $scanpatientlist->is_reportdelivered = ($scanpatientlist->is_reportdelivered == null) ? Carbon::now() : null;
        $scanpatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($scanpatientlist->is_reportdelivered == null) ? 'warning' : 'success', 'message' => 'Delivery Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $scanpatientlist, 'labinvestigation_markdeliverydone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedDeliveryNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->delivery_note as $key => $value) {
                Scanpatientlist::find($key)->update([
                    'delivery_note' => $value,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('updatedDeliveryNoteLivewire', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('updatedDeliveryNoteLivewire', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('updatedDeliveryNoteLivewire', 'three', $e);
        }

    }

    public function render()
    {
        $this->scanpatient = Scanpatient::where('uuid', $this->uuid)->first();
        foreach ($this->scanpatient->scanpatientlist as $eachlabdeliverynote) {
            $this->delivery_note[$eachlabdeliverynote->id] = $eachlabdeliverynote->delivery_note;
        }

        return view('livewire.laboratory.scan.patientlist.scandeliverylivewire');
    }
}
