<?php

namespace App\Http\Livewire\Laboratory\Scan\Patientlist;

use App\Models\Laboratory\Scan\Scanpatient;
use App\Models\Laboratory\Scan\Scanpatientlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Scansamplelivewire extends Component
{
    public $uuid, $scanpatient, $sample_note;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function marksampledone(Scanpatientlist $scanpatientlist)
    {
        $scanpatientlist->is_sampletaken = ($scanpatientlist->is_sampletaken == null) ? Carbon::now() : null;
        $scanpatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($scanpatientlist->is_sampletaken == null) ? 'warning' : 'success', 'message' => 'Sample Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $scanpatientlist, 'labinvestigation_marksampledone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedSampleNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->sample_note as $key => $value) {
                Scanpatientlist::find($key)->update([
                    'sample_note' => $value,
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
        $this->scanpatient = Scanpatient::where('uuid', $this->uuid)->first();
        foreach ($this->scanpatient->scanpatientlist as $eachlabsamplenote) {
            $this->sample_note[$eachlabsamplenote->id] = $eachlabsamplenote->sample_note;
        }

        return view('livewire.laboratory.scan.patientlist.scansamplelivewire');
    }
}
