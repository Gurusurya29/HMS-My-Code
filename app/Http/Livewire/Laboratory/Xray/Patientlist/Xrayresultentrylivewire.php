<?php

namespace App\Http\Livewire\Laboratory\Xray\Patientlist;

use App\Models\Laboratory\Xray\Xraypatient;
use App\Models\Laboratory\Xray\Xraypatientlist;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Xrayresultentrylivewire extends Component
{
    use WithFileUploads;
    use UploadTrait;

    public $uuid, $xraypatient, $result_note, $xray_image, $is_imageexists;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function markreportdone(Xraypatientlist $xraypatientlist)
    {
        $xraypatientlist->is_resultupdated = ($xraypatientlist->is_resultupdated == null) ? Carbon::now() : null;
        $xraypatientlist->save();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($xraypatientlist->is_resultupdated == null) ? 'warning' : 'success', 'message' => 'Result Updated Successfully']);
        // Helper::trackmessage(auth()->user(), $xraypatientlist, 'labinvestigation_markreportdone', session()->getId(), 'WEB', 'Investigation Sample mark as done');
    }

    public function updatedResultNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->result_note as $key => $value) {
                Xraypatientlist::find($key)->update([
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

    public function imagestore($xraypatientlist_id)
    {
        $validated_image = $this->validate([
            'xray_image.' . $xraypatientlist_id => 'required|image',
        ], [
            'xray_image.' . $xraypatientlist_id . '.required' => 'Upload Image',
        ]);
        try {
            DB::beginTransaction();
            $xraypatientlist = Xraypatientlist::find($xraypatientlist_id);
            if ($this->xray_image[$xraypatientlist_id]) {
                $updatedxrayimage = $this->uploadfile($xraypatientlist_id, $this->xray_image[$xraypatientlist_id], '/laboratory/xraypatient/' . $this->xraypatient->uniqid, 'App\Models\Laboratory\Xray\Xraypatientlist', 'xray_image');
            }
            $is_imageupdated = $xraypatientlist->update(['xray_image' => $updatedxrayimage]);

            DB::commit();
            $this->dispatchBrowserEvent('alert',
                ['type' => ($is_imageupdated) ? 'success' : 'warning', 'message' => ($is_imageupdated) ? 'Image Upoaded Successfully' : 'Something Went Wrong!']);
            return redirect()->route('xrayresultentry', $this->uuid);
        } catch (Exception $e) {
            $this->exceptionerror('xrayimageuploadLivewire', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('xrayimageuploadLivewire', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('xrayimageuploadLivewire', 'three', $e);
        }
    }

    public function render()
    {
        $this->xraypatient = Xraypatient::where('uuid', $this->uuid)->first();
        foreach ($this->xraypatient->xraypatientlist as $eachlabreportnote) {
            $this->result_note[$eachlabreportnote->id] = $eachlabreportnote->result_note;
        }
        return view('livewire.laboratory.xray.patientlist.xrayresultentrylivewire');
    }
}
