<?php

namespace App\Http\Livewire\Laboratory\Xray\Patientlist;

use App\Models\Laboratory\Xray\Xraypatient;
use App\Models\Laboratory\Xray\Xraypatientlist;
use Carbon\Carbon;
use Livewire\Component;

class Xraypatientmovetobilllivewire extends Component
{

    public $uuid, $xraypatient;
    public $selectedtotalxraycost = 0, $discount_percentage = 0, $calculated_grandtotal = 0, $grand_total = 0, $discount_value = 0;

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

    public function markmovedtobill(Xraypatientlist $xraypatientlist)
    {
        $xraypatientlist->is_movedtobill = ($xraypatientlist->is_movedtobill == null) ? Carbon::now() : null;
        $xraypatientlist->save();
        $this->Updateddiscountpercentage();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($xraypatientlist->is_movedtobill == null) ? 'warning' : 'success', 'message' => 'Moved To Bill Updated Successfully']);
    }

    public function saveandexit()
    {
        // Need to check later
        if ($this->xraypatient->xraypatientlist->whereNotNull('is_movedtobill')->count() > 0) {
            $user = auth()->guard('laboratory')->user();

            $this->xraypatient->update([
                'total' => $this->xraypatient->xraypatientlist->whereNotNull('is_movedtobill')->sum('fee'),
                'discount_percentage' => $this->discount_percentage != null ? $this->discount_percentage : 0,
                'discount_value' => $this->discount_value != null ? $this->discount_value : 0,
                'grand_total' => $this->grand_total,
                'is_billgenerated' => true,
            ]);
            // Patient Statement
            $user->patientstatementcreatable()->make([
                'patient_id' => $this->xraypatient->patient->id,
                'credit' => 0,
                'debit' => $this->grand_total,
                'note' => 'Investigation Bill For Laboratory',
                'entity_type' => 2,
                'transaction_type' => 'D',
                'statement_ref_id' => $this->xraypatient->uniqid,
            ])
                ->statementable()
                ->associate($this->xraypatient)
                ->save();

            // Hospital Statement
            $user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'debit' => $this->grand_total,
                'note' => 'Investigation Bill For Laboratory',
                'entity_type' => 2,
                'transaction_type' => 'D',
                'statement_ref_id' => $this->xraypatient->uniqid,
            ])
                ->userable()
                ->associate($this->xraypatient->patient)
                ->hstatementable()
                ->associate($this->xraypatient)
                ->save();

        }

        return redirect()->route('xraypatientlist');
    }

    public function Updateddiscountpercentage()
    {
        $this->selectedtotalxraycost = Xraypatient::where('uuid', $this->uuid)->first()->xraypatientlist->whereNotNull('is_movedtobill')->sum('fee');
        $this->calculated_grandtotal = ((intval($this->discount_percentage) ?? 0) / 100) * $this->selectedtotalxraycost;
    }

    public function render()
    {
        $this->xraypatient = Xraypatient::where('uuid', $this->uuid)->first();
        $this->selectedtotalxraycost = $this->xraypatient->xraypatientlist->where('is_movedtobill', true)->sum('fee');
        $this->discount_value = $this->discount_percentage == 0 ? 0 : $this->calculated_grandtotal;
        $this->grand_total = $this->discount_percentage == 0 ? $this->selectedtotalxraycost : $this->selectedtotalxraycost - $this->calculated_grandtotal;
        return view('livewire.laboratory.xray.patientlist.xraypatientmovetobilllivewire');
    }

}
