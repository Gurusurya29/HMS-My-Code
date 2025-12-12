<?php

namespace App\Http\Livewire\Admin\Inpatient\Ipnursingstation\Ipscheduleot;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ipscheduleotlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    public $inpatient, $doctorlist, $bedorroomnumber_data = [];

    public $doctor_id, $bedorroomnumber_id, $surgery_name, $surgery_startdate, $surgery_enddate, $schedule_note;
    public $otscheduledata;
    public $is_otactive = false;

    public function mount($inpatient_uuid, $otschedule_uuid)
    {
        $this->otscheduledata = Otschedule::where('uuid', $otschedule_uuid)->first();
        if ($this->otscheduledata) {
            $this->inpatient = $this->otscheduledata->inpatient;
            $this->doctor_id = $this->otscheduledata->doctor_id;
            $this->bedorroomnumber_id = $this->otscheduledata->bedorroomnumber_id;
            $this->surgery_name = $this->otscheduledata->surgery_name;
            $this->surgery_startdate = $this->otscheduledata->surgery_startdate;
            $this->surgery_enddate = $this->otscheduledata->surgery_enddate;
            $this->schedule_note = $this->otscheduledata->schedule_note;
            $this->is_otactive = $this->otscheduledata->is_otactive;
        }
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->doctorlist = Doctor::where('active', true)->get();
        $this->bedorroomnumber_data = Bedorroomnumber::where('active', true)
            ->where('is_available', 0)
            ->where('is_ot', true)
            ->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'doctor_id' => 'required|numeric',
            'bedorroomnumber_id' => 'required',
            'surgery_name' => 'required',
            'surgery_startdate' => 'required',
            'surgery_enddate' => 'required',
            'schedule_note' => 'required|max:255',
            'is_otactive' => 'nullable|boolean',
        ];
    }

    public function hydrate()
    {
        $this->dispatch('loaddoctorSelect2Hydrate');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->otscheduledata) {

                $otschedule = $this->otscheduledata;
                $otschedule->update($validatedData);
                $user->otscheduleupdatable()->save($otschedule);
                Helper::trackmessage($user, $otschedule, 'otschedule_createoredit', session()->getId(), 'WEB', 'OT Surgery details Updated');
                $this->toaster('success', 'OT Surgery details Updated Successfully!!');

            } else {
                $validatedData['patient_id'] = $this->inpatient->patient_id;
                $validatedData['inpatient_id'] = $this->inpatient->id;
                $validatedData['is_otactive'] = $this->is_otactive;
                $otschedule = $user->otschedulecreatable()
                    ->create($validatedData);
                $otbilling = $user->otbillingcreatable()
                    ->create([
                        'patient_id' => $otschedule->patient_id,
                        'patientvisit_id' => $otschedule->inpatient->patientvisit_id,
                        'inpatient_id' => $otschedule->inpatient_id,
                        'otschedule_id' => $otschedule->id,
                        'total' => 0,
                        'discount' => 0,
                        'sub_total' => 0,
                        'billdiscount_amount' => 0,
                        'grand_total' => 0,
                    ]);
                Helper::trackmessage($user, $otschedule, 'otschedule_createoredit', session()->getId(), 'WEB', 'OT Scheduled');
                $this->toaster('success', 'OT Scheduled Successfully!!');
            }
            DB::commit();
            return redirect()->route('ipscheduleotlist', $this->inpatient->uuid);
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_otschedules_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_otschedules_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_otschedules_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function surgerydatevaildate($date_type)
    {
        $currendata_id = $this->otscheduledata->id ?? '';
        $prev_otschedules = Otschedule::where('active', true)
            ->whereNull('is_movetoip')
            ->where('bedorroomnumber_id', $this->bedorroomnumber_id)
            ->whereNotIn('id', [$currendata_id])
            ->get();
        foreach ($prev_otschedules as $key => $value) {
            $start_date = Carbon::parse($value->surgery_startdate);
            $end_date = Carbon::parse($value->surgery_enddate);
            if ($date_type == 'startdate') {
                $check_date = Carbon::parse($this->surgery_startdate);
            } else {
                $check_date = Carbon::parse($this->surgery_enddate);
            }
            $check = $check_date->isBetween($start_date, $end_date);
            if ($check) {
                if ($date_type == 'startdate') {
                    $this->surgery_startdate = '';
                } else {
                    $this->surgery_enddate = '';
                }
                $this->dispatch('datealert');
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.inpatient.ipnursingstation.ipscheduleot.ipscheduleotlivewire');
    }
}
