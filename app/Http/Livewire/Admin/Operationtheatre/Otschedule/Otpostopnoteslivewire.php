<?php

namespace App\Http\Livewire\Admin\Operationtheatre\Otschedule;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Otpostopnoteslivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    public $otschedule, $otsurgerypostopdata;
    public $postop_note, $postopadditional_note, $postop_remarks, $surgerystart_time, $surgeryend_time, $observationhours;

    public function mount($otschedule_uuid)
    {
        $this->otschedule = Otschedule::where('uuid', $otschedule_uuid)->first();
        $this->otsurgerypostopdata = $this->otschedule->otsurgerypostop;
        if ($this->otsurgerypostopdata) {
            $this->postop_note = $this->otsurgerypostopdata->postop_note;
            $this->postopadditional_note = $this->otsurgerypostopdata->postopadditional_note;
            $this->postop_remarks = $this->otsurgerypostopdata->postop_remarks;
            $this->surgerystart_time = $this->otsurgerypostopdata->surgerystart_time;
            $this->surgeryend_time = $this->otsurgerypostopdata->surgeryend_time;
            $this->observationhours = $this->otsurgerypostopdata->observationhours;
        }
    }

    protected function rules()
    {
        return [
            'postop_note' => 'required|max:255',
            'postopadditional_note' => 'required',
            'postop_remarks' => 'required',
            'surgerystart_time' => 'required',
            'surgeryend_time' => 'required',
            'observationhours' => 'required',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->otsurgerypostopdata) {
                $otsurgerypostop = $this->otsurgerypostopdata;
                $otsurgerypostop->update($validatedData);
                $user->otsurgerypostopupdatable()->save($otsurgerypostop);
                Helper::trackmessage($user, $otsurgerypostop, 'otsurgerypostop_createoredit', session()->getId(), 'WEB', 'OT Post-Op Details Updated');
                $this->toaster('success', 'OT Post-Op Details Updated Successfully!!');

            } else {
                $validatedData['patient_id'] = $this->otschedule->patient_id;
                $validatedData['inpatient_id'] = $this->otschedule->inpatient_id;
                $validatedData['otschedule_id'] = $this->otschedule->id;
                $otsurgerypostop = $user->otsurgerypostopcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $otsurgerypostop, 'otsurgerypostop_createoredit', session()->getId(), 'WEB', 'OT Post-Op Details Saved');
                $this->toaster('success', 'OT Post-Op Details Saved Successfully!!');
            }
            DB::commit();
            return redirect()->route('otschedulelist');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_otsurgerypostops_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_otsurgerypostops_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_otsurgerypostops_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.operationtheatre.otschedule.otpostopnoteslivewire');
    }
}
