<?php

namespace App\Http\Livewire\Laboratory\Laboratory\Patientlist;

use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Laboratory\Labpatientlist;
use Carbon\Carbon;
use Livewire\Component;

class Labpatientmovetobilllivewire extends Component
{

    public $uuid, $labpatient, $sample_note, $senttoexternal_note;
    public $selectedtotallabcost = 0, $discount_percentage = 0, $calculated_grandtotal = 0, $grand_total = 0, $discount_value = 0;

    protected function rules()
    {
        return [
            'discount_percentage' => 'nullable|numeric|integer|gte:0|lte:100',
        ];
    }

    protected function messages()
    {
        return [
            'discount_percentage.integer' => 'Enter valid value.',
        ];
    }

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function markmovedtobill(Labpatientlist $labpatientlist)
    {
        $labpatientlist->is_movedtobill = ($labpatientlist->is_movedtobill == null) ? Carbon::now() : null;
        $labpatientlist->save();
        $this->Updateddiscountpercentage();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($labpatientlist->is_movedtobill == null) ? 'warning' : 'success', 'message' => 'Moved To Bill Updated Successfully']);

    }
    public function saveandexit()
    {
// Need to check later
        if ($this->labpatient->labpatientlist->whereNotNull('is_movedtobill')->count() > 0) {
            $user = auth()->guard('laboratory')->user();
            $this->labpatient->update([
                'total' => $this->labpatient->labpatientlist->whereNotNull('is_movedtobill')->sum('fee'),
                'discount_percentage' => $this->discount_percentage != null ? $this->discount_percentage : 0,
                'discount_value' => $this->discount_value != null ? $this->discount_value : 0,
                'grand_total' => $this->grand_total,
                'is_billgenerated' => true,
            ]);
            // Patient Statement
            $user->patientstatementcreatable()->make([
                'patient_id' => $this->labpatient->patient->id,
                'credit' => 0,
                'debit' => $this->grand_total,
                'note' => 'Investigation Bill For Laboratory',
                'entity_type' => 2,
                'transaction_type' => 'D',
                'statement_ref_id' => $this->labpatient->uniqid,
            ])
                ->statementable()
                ->associate($this->labpatient)
                ->save();

            // Hospital Statement
            $user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'debit' => $this->grand_total,
                'note' => 'Investigation Bill For Laboratory',
                'entity_type' => 2,
                'transaction_type' => 'D',
                'statement_ref_id' => $this->labpatient->uniqid,
            ])
                ->userable()
                ->associate($this->labpatient->patient)
                ->hstatementable()
                ->associate($this->labpatient)
                ->save();

        }

        return redirect()->route('laboratorypatientlist');
    }

    public function Updateddiscountpercentage()
    {
        $this->selectedtotallabcost = Labpatient::where('uuid', $this->uuid)->first()->labpatientlist->whereNotNull('is_movedtobill')->sum('fee');
        $this->calculated_grandtotal = ((intval($this->discount_percentage) ?? 0) / 100) * $this->selectedtotallabcost;
    }

    public function render()
    {
        $this->labpatient = Labpatient::where('uuid', $this->uuid)->first();
        $this->selectedtotallabcost = $this->labpatient->labpatientlist->where('is_movedtobill', true)->sum('fee');
        $this->discount_value = $this->discount_percentage == 0 ? 0 : $this->calculated_grandtotal;
        $this->grand_total = $this->discount_percentage == 0 ? $this->selectedtotallabcost : $this->selectedtotallabcost - $this->calculated_grandtotal;
        return view('livewire.laboratory.laboratory.patientlist.labpatientmovetobilllivewire');
    }
}
