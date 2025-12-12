<?php

namespace App\Http\Livewire\Laboratory\Laboratory\Patientlist;

use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Laboratory\Labpatientlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labdeliverylivewire extends Component
{

    public $uuid, $labpatient, $delivery_note;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function markdeliverydone(Labpatientlist $labpatientlist)
    {
        $labpatientlist->is_reportdelivered = ($labpatientlist->is_reportdelivered == null) ? Carbon::now() : null;
        $labpatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($labpatientlist->is_reportdelivered == null) ? 'warning' : 'success', 'message' => 'Delivery Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $labpatientlist, 'labinvestigation_markdeliverydone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedDeliveryNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->delivery_note as $key => $value) {
                Labpatientlist::find($key)->update([
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
        $this->labpatient = Labpatient::where('uuid', $this->uuid)->first();
        foreach ($this->labpatient->labpatientlist as $eachlabdeliverynote) {
            $this->delivery_note[$eachlabdeliverynote->id] = $eachlabdeliverynote->delivery_note;
        }

        return view('livewire.laboratory.laboratory.patientlist.labdeliverylivewire');
    }
}
