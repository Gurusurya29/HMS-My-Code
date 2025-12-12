<?php

namespace App\Http\Livewire\Laboratory\Scan\Patientlist;

use App\Models\Laboratory\Scan\Scanpatient;
use App\Models\Laboratory\Scan\Scanpatientlist;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Scanresultentrylivewire extends Component
{
    use WithFileUploads;
    use UploadTrait;

    public $uuid, $scanpatient, $result_note, $scan_image;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function markreportdone(Scanpatientlist $scanpatientlist)
    {
        $scanpatientlist->is_resultupdated = ($scanpatientlist->is_resultupdated == null) ? Carbon::now() : null;
        $scanpatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($scanpatientlist->is_resultupdated == null) ? 'warning' : 'success', 'message' => 'Result Updated Successfully']);

        // Helper::trackmessage(auth()->user(), $scanpatientlist, 'labinvestigation_markreportdone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedResultNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->result_note as $key => $value) {
                Scanpatientlist::find($key)->update([
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

    public function imagestore($scanpatientlist_id)
    {
        $validated_image = $this->validate([
            'scan_image.' . $scanpatientlist_id => 'required|image',
        ], [
            'scan_image.' . $scanpatientlist_id . '.required' => 'Upload Image',
        ]);
        try {
            DB::beginTransaction();
            $scanpatientlist = Scanpatientlist::find($scanpatientlist_id);
            if ($this->scan_image[$scanpatientlist_id]) {
                $updatedscanimage = $this->uploadfile($scanpatientlist_id, $this->scan_image[$scanpatientlist_id], '/laboratory/scanpatient/' . $this->scanpatient->uniqid, 'App\Models\Laboratory\Scan\Scanpatientlist', 'scan_image');
            }
            $is_imageupdated = $scanpatientlist->update(['scan_image' => $updatedscanimage]);

            DB::commit();
            $this->dispatchBrowserEvent('alert',
                ['type' => ($is_imageupdated) ? 'success' : 'warning', 'message' => ($is_imageupdated) ? 'Image Upoaded Successfully' : 'Something Went Wrong!']);
            return redirect()->route('scanresultentry', $this->uuid);
        } catch (Exception $e) {
            $this->exceptionerror('scanimagestoreLivewire', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('scanimagestoreLivewire', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('scanimagestoreLivewire', 'three', $e);
        }
    }

    public function render()
    {
        $this->scanpatient = Scanpatient::where('uuid', $this->uuid)->first();
        foreach ($this->scanpatient->scanpatientlist as $eachlabreportnote) {
            $this->result_note[$eachlabreportnote->id] = $eachlabreportnote->result_note;
        }
        return view('livewire.laboratory.scan.patientlist.scanresultentrylivewire');
    }
}
