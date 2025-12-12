<?php

namespace App\Http\Livewire\Laboratory\Laboratory\Patientlist;

use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Laboratory\Labpatientlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Labsamplelivewire extends Component
{

    public $uuid, $labpatient, $sample_note, $senttoexternal_note;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function marksampledone(Labpatientlist $labpatientlist)
    {
        $labpatientlist->is_sampletaken = ($labpatientlist->is_sampletaken == null) ? Carbon::now() : null;
        $labpatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($labpatientlist->is_sampletaken == null) ? 'warning' : 'success', 'message' => 'Sample Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $labpatientlist, 'labinvestigation_marksampledone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function markexternaldone(Labpatientlist $labpatientlist)
    {
        $labpatientlist->is_senttoexternallab = ($labpatientlist->is_senttoexternallab == null) ? Carbon::now() : null;
        $labpatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($labpatientlist->is_senttoexternallab == null) ? 'warning' : 'success', 'message' => 'Lab Sent External Status Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $labpatientlist, 'labinvestigation_marksampledone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedSampleNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->sample_note as $key => $value) {
                Labpatientlist::find($key)->update([
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

    public function updatedSenttoexternalNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->senttoexternal_note as $key => $value) {
                Labpatientlist::find($key)->update([
                    'senttoexternal_note' => $value,
                ]);

            }

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('updatedSenttoexternalNoteLivewire', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('updatedSenttoexternalNoteLivewire', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('updatedSenttoexternalNoteLivewire', 'three', $e);
        }

    }

    public function render()
    {
        $this->labpatient = Labpatient::where('uuid', $this->uuid)->first();
        foreach ($this->labpatient->labpatientlist as $eachlabsamplenote) {
            $this->sample_note[$eachlabsamplenote->id] = $eachlabsamplenote->sample_note;
            $this->senttoexternal_note[$eachlabsamplenote->id] = $eachlabsamplenote->senttoexternal_note;
        }

        return view('livewire.laboratory.laboratory.patientlist.labsamplelivewire');
    }
}
