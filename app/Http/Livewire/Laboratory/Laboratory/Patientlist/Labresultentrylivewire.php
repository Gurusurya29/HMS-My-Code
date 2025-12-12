<?php

namespace App\Http\Livewire\Laboratory\Laboratory\Patientlist;

use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Laboratory\Labpatientlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labresultentrylivewire extends Component
{

    public $uuid, $labpatient, $result_note;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function markreportdone(Labpatientlist $labpatientlist)
    {
        $labpatientlist->is_resultupdated = ($labpatientlist->is_resultupdated == null) ? Carbon::now() : null;
        $labpatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($labpatientlist->is_resultupdated == null) ? 'warning' : 'success', 'message' => 'Result Updated Successfully']);

        // Helper::trackmessage(auth()->user(), $labpatientlist, 'labinvestigation_markreportdone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedResultNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->result_note as $key => $value) {
                Labpatientlist::find($key)->update([
                    'result_note' => $value,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('updatedSampleNoteLivewire', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('updatedSampleNoteLivewire', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('updatedSampleNoteLivewire', 'three', $e);
        }

    }

    public function render()
    {
        $this->labpatient = Labpatient::where('uuid', $this->uuid)->first();
        foreach ($this->labpatient->labpatientlist as $eachlabreportnote) {
            $this->result_note[$eachlabreportnote->id] = $eachlabreportnote->result_note;
        }

        return view('livewire.laboratory.laboratory.patientlist.labresultentrylivewire');
    }
}
