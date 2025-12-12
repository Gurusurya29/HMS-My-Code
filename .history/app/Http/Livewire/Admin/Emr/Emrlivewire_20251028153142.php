<?php

namespace App\Http\Livewire\Admin\Emr;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Models\Admin\Emr\Emr;
use App\Models\Patient\Auth\Patient;
use Livewire\Component;

class Emrlivewire extends Component
{
    use datatableLivewireTrait;

    public $searchquery, $patient, $patientlist = [];

    public $showdata, $showdatatype;

    public function updatedSearchquery()
    {
        $this->patientlist = Patient::where('active', true)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%')
                    ->orWhere('phone', 'like', '%' . $this->searchquery . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchquery . '%')
                    ->orWhere('uhid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();
    }

    public function selectedpatient(Patient $patient)
    {
        $this->patient = $patient;
        $this->searchquery = '';
    }

    public function show($emr_id, $showdatatype)
    {
        $this->showdatatype = $showdatatype;
        $this->showdata = Emr::find($emr_id)->emrable;
        // $this->dispatch('showModal');
        // $this->dispatch('showModal')->self()->with([ 'id' => $emr_id ])->delay(50)->nextTick();
    }

    protected function toaster($type, $message)
    {
        $this->dispatchBrowserEvent('alert',
            ['type' => $type, 'message' => $message]);
    }

    public function downloadFile($uniqid, $file_name)
    {
        if ($this->showdatatype == 'Out Patient') {
            $file = storage_path('app/public/admin/outpatient/' . $uniqid . '/' . $file_name);
        } elseif ($this->showdatatype == 'In Patient') {
            $file = storage_path('app/public/admin/ipassesment/' . $uniqid . '/' . $file_name);
        }

        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function printprescription($outpatient_id)
    {
        $this->dispatch('printprescription', $outpatient_id);
    }
    public function opprintinvestigation($outpatient_id)
    {
        $this->dispatch('opprintinvestigation', $outpatient_id);
    }
    public function opprintinvestigationresult($outpatient_id)
    {
        $this->dispatch('opprintinvestigationresult', $outpatient_id);
    }

    public function printipprescription($ipassessment_id)
    {
        $this->dispatch('printipprescription', $ipassessment_id);
    }

    public function printipinvestigation($ipassessment_id)
    {
        $this->dispatch('printipinvestigation', $ipassessment_id);
    }
    public function printipinvestigationresult($ipassessment_id)
    {
        $this->dispatch('printipinvestigationresult', $ipassessment_id);
    }

    public function render()
    {
        if ($this->patient) {
            $emrlist = Emr::where('patient_id', $this->patient->id)
                ->latest()
                ->paginate($this->paginationlength)
                ->onEachSide(1);
        } else {
            $emrlist = null;
        }

        return view('livewire.admin.emr.emrlivewire', compact('emrlist'));
    }
}
