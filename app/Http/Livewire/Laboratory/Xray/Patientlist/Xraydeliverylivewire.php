<?php

namespace App\Http\Livewire\Laboratory\Xray\Patientlist;

use App\Models\Laboratory\Xray\Xraypatient;
use App\Models\Laboratory\Xray\Xraypatientlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Xraydeliverylivewire extends Component
{
    public $uuid, $xraypatient, $delivery_note;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function markdeliverydone(Xraypatientlist $xraypatientlist)
    {
        $xraypatientlist->is_reportdelivered = ($xraypatientlist->is_reportdelivered == null) ? Carbon::now() : null;
        $xraypatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($xraypatientlist->is_reportdelivered == null) ? 'warning' : 'success', 'message' => 'Delivery Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $xraypatientlist, 'labinvestigation_markdeliverydone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedDeliveryNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->delivery_note as $key => $value) {
                Xraypatientlist::find($key)->update([
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
        $this->xraypatient = Xraypatient::where('uuid', $this->uuid)->first();
        foreach ($this->xraypatient->xraypatientlist as $eachlabdeliverynote) {
            $this->delivery_note[$eachlabdeliverynote->id] = $eachlabdeliverynote->delivery_note;
        }

        return view('livewire.laboratory.xray.patientlist.xraydeliverylivewire');
    }
}
