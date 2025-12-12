<?php

namespace App\Http\Livewire\Laboratory\Xray\Patientlist;

use App\Models\Laboratory\Xray\Xraypatient;
use App\Models\Laboratory\Xray\Xraypatientlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Xraysamplelivewire extends Component
{
    public $uuid, $xraypatient, $sample_note;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function marksampledone(Xraypatientlist $xraypatientlist)
    {
        $xraypatientlist->is_sampletaken = ($xraypatientlist->is_sampletaken == null) ? Carbon::now() : null;
        $xraypatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($xraypatientlist->is_sampletaken == null) ? 'warning' : 'success', 'message' => 'Sample Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $xraypatientlist, 'labinvestigation_marksampledone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedSampleNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->sample_note as $key => $value) {
                Xraypatientlist::find($key)->update([
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
        $this->xraypatient = Xraypatient::where('uuid', $this->uuid)->first();
        foreach ($this->xraypatient->xraypatientlist as $eachlabsamplenote) {
            $this->sample_note[$eachlabsamplenote->id] = $eachlabsamplenote->sample_note;
        }

        return view('livewire.laboratory.xray.patientlist.xraysamplelivewire');
    }
}
