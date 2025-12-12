<?php

namespace App\Http\Livewire\Laboratory\Scan\Patientlist;

use App\Models\Laboratory\Scan\Scanpatient;
use App\Models\Laboratory\Scan\Scanpatientlist;
use Carbon\Carbon;
use Livewire\Component;

class Scanpatientmovetobilllivewire extends Component
{

    public $uuid, $scanpatient;
    public $selectedtotalscancost = 0, $discount_percentage = 0, $calculated_grandtotal = 0, $grand_total = 0, $discount_value = 0;

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

    public function markmovedtobill(Scanpatientlist $scanpatientlist)
    {
        $scanpatientlist->is_movedtobill = ($scanpatientlist->is_movedtobill == null) ? Carbon::now() : null;
        $scanpatientlist->save();
        $this->Updateddiscountpercentage();
        $this->dispatchBrowserEvent('alert',
            ['type' => ($scanpatientlist->is_movedtobill == null) ? 'warning' : 'success', 'message' => 'Moved To Bill Updated Successfully']);
    }
    public function saveandexit()
    {
        // Need to check later
        if ($this->scanpatient->scanpatientlist->whereNotNull('is_movedtobill')->count() > 0) {
            $user = auth()->guard('laboratory')->user();
            $this->scanpatient->update([
                'total' => $this->scanpatient->scanpatientlist->whereNotNull('is_movedtobill')->sum('fee'),
                'discount_percentage' => $this->discount_percentage != null ? $this->discount_percentage : 0,
                'discount_value' => $this->discount_value != null ? $this->discount_value : 0,
                'grand_total' => $this->grand_total,
                'is_billgenerated' => true,
            ]);
            // Patient Statement
            $user->patientstatementcreatable()->make([
                'patient_id' => $this->scanpatient->patient->id,
                'credit' => 0,
                'debit' => $this->grand_total,
                'note' => 'Investigation Bill For Scanoratory',
                'entity_type' => 2,
                'transaction_type' => 'D',
                'statement_ref_id' => $this->scanpatient->uniqid,
            ])
                ->statementable()
                ->associate($this->scanpatient)
                ->save();

            // Hospital Statement
            $user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'debit' => $this->grand_total,
                'note' => 'Investigation Bill For Scanoratory',
                'entity_type' => 2,
                'transaction_type' => 'D',
                'statement_ref_id' => $this->scanpatient->uniqid,
            ])
                ->userable()
                ->associate($this->scanpatient->patient)
                ->hstatementable()
                ->associate($this->scanpatient)
                ->save();

        }

        return redirect()->route('scanpatientlist');
    }

    public function Updateddiscountpercentage()
    {
        $this->selectedtotalscancost = Scanpatient::where('uuid', $this->uuid)->first()->scanpatientlist->whereNotNull('is_movedtobill')->sum('fee');
        $this->calculated_grandtotal = ((intval($this->discount_percentage) ?? 0) / 100) * $this->selectedtotalscancost;
    }

    public function render()
    {
        $this->scanpatient = Scanpatient::where('uuid', $this->uuid)->first();
        $this->selectedtotalscancost = $this->scanpatient->scanpatientlist->where('is_movedtobill', true)->sum('fee');
        $this->discount_value = $this->discount_percentage == 0 ? 0 : $this->calculated_grandtotal;
        $this->grand_total = $this->discount_percentage == 0 ? $this->selectedtotalscancost : $this->selectedtotalscancost - $this->calculated_grandtotal;
        return view('livewire.laboratory.scan.patientlist.scanpatientmovetobilllivewire');
    }

}
