<?php

namespace App\Http\Livewire\Pharmacy\Common\Patient;

use App\Models\Patient\Auth\Patient;
use Livewire\Component;

class Searchpatientlivewire extends Component
{
    public $patient, $patientlist, $highlightIndex, $ispatientselected = false, $patient_id,
        $required;
    protected $listeners = ['resetData'];

    public function mount($patient_id = null, $required = true)
    {
        $this->resetData();
        if ($patient_id) {
            $this->patient_id = $patient_id;
            $this->patient = Patient::find($patient_id)->name;
            $this->ispatientselected = true;
        }
        if (!$required) {
            $this->required = false;
        }
    }

    public function resetData()
    {
        $this->patient = '';
        $this->patientlist = [];
        $this->highlightIndex = 0;
        $this->dispatch('patientdeselected', $id = null);
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->patientlist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->patientlist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function updatedPatient()
    {
        $this->ispatientselected = false;
        if ($this->patient) {
            $this->patientlist = Patient::where(function ($patient) {
                $patient->where('name', 'like', '%' . $this->patient . '%')
                    ->orWhere('phone', 'like', '%' . $this->patient . '%')
                    ->orWhere('uhid', 'like', '%' . $this->patient . '%');
            })
                ->get();
        } else {
            $this->resetData();
        }
    }

    public function selectPatient()
    {
        $patient = $this->patientlist[$this->highlightIndex] ?? null;
        if ($patient) {
            $higlightpatient = $this->patientlist[$this->highlightIndex];
            $this->selecthispatient($higlightpatient->id, $higlightpatient->phone, $higlightpatient->name, $higlightpatient->uhid);
        }
    }

    public function selecthispatient($id, $phone, $name, $uhid)
    {
        $this->ispatientselected = true;
        $this->patient = $phone . '   ' . $name . '   ' . $uhid;
        $this->dispatch('patientselected', $id);
    }

    public function render()
    {
        return view('livewire.pharmacy.common.patient.searchpatientlivewire');
    }
}
