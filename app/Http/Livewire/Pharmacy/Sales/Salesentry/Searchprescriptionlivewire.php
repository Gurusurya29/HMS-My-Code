<?php

namespace App\Http\Livewire\Pharmacy\Sales\Salesentry;

use App\Models\Admin\Prescription\Prescription;
use Livewire\Component;

class Searchprescriptionlivewire extends Component
{
    public $isprescriptionselected ;
    public $patient_id, $prescription, $pharmprescriptionlist = [], $highlightIndex = 0,
    $fromhms = false;

    public function mount($patient_id, $selected = null)
    {
        $this->resetData();
        $this->patient_id = $patient_id;

        if ($selected) {
            $this->prescription = Prescription::where('uuid', $selected)->first()->uniqid;
            $this->isprescriptionselected = true;
            $this->fromhms = true;
        }
    }

    public function resetData()
    {
        $this->prescription = '';
        $this->pharmprescriptionlist = [];
        $this->highlightIndex = 0;
        $this->dispatch('prescription', $id = null);
    }

    public function updatedPrescription()
    {
        $this->isprescriptionselected = false;
        $this->pharmprescriptionlist = Prescription::where('patient_id', $this->patient_id)
            ->where(function ($prescription) {
                $prescription->where('uniqid', 'like', '%' . $this->prescription . '%')
                    ->orWhere('created_at', 'like', '%' . $this->prescription . '%');
            })
            ->get();
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->pharmprescriptionlist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->pharmprescriptionlist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectPrescription()
    {
        $prescription = $this->pharmprescriptionlist[$this->highlightIndex] ?? null;
        if ($prescription) {
            $prescriptiondetail = $this->pharmprescriptionlist[$this->highlightIndex];
            $this->selecthisprescription($prescriptiondetail['id'], $prescriptiondetail['uniqid']);
        }
    }

    public function selecthisprescription($id, $uidid)
    {
        $this->isprescriptionselected = true;
        $this->prescription = $uidid;
        $this->dispatch('prescriptionselected', $id);
    }

    public function render()
    {
        return view('livewire.pharmacy.sales.salesentry.searchprescriptionlivewire');
    }
}
