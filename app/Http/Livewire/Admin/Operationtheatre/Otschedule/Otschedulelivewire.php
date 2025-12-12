<?php

namespace App\Http\Livewire\Admin\Operationtheatre\Otschedule;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Otschedulelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $inpatient, $searchquery, $doctorlist, $inpatientlist = [], $bedorroomnumber_data = [];

    public $doctor_id, $bedorroomnumber_id, $surgery_name, $surgery_startdate, $surgery_enddate, $schedule_note;
    public $is_movedto_ot, $chief_surgeon, $senior_surgeon, $asst_surgeon, $nursing_asst, $anaesthetist, $others, $surgery_details;

    public $otscheduledata;

    public function mount($otschedule_uuid)
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

            $this->is_movedto_ot = $this->otscheduledata->is_movedto_ot ? true : false;
            $this->chief_surgeon = $this->otscheduledata->chief_surgeon;
            $this->senior_surgeon = $this->otscheduledata->senior_surgeon;
            $this->asst_surgeon = $this->otscheduledata->asst_surgeon;
            $this->nursing_asst = $this->otscheduledata->nursing_asst;
            $this->anaesthetist = $this->otscheduledata->anaesthetist;
            $this->others = $this->otscheduledata->others;
            $this->surgery_details = $this->otscheduledata->surgery_details;

        }
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
        ];
    }

    public function updatedSearchquery()
    {
        $this->inpatientlist = Inpatient::with('patient')
            ->where('active', true)
            ->whereHas('ipadmission')
            ->whereNull('is_patientdischarged')
            ->whereHas('patient', function (Builder $query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uhid', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('phone', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get();
    }

    public function selectedpatient(Inpatient $inpatient)
    {
        $this->inpatient = $inpatient;
        $this->searchquery = '';
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
                $validate_surgerydetails = $this->validate([
                    'is_movedto_ot' => 'required',
                    'chief_surgeon' => 'required',
                    'senior_surgeon' => 'required',
                    'asst_surgeon' => 'required',
                    'nursing_asst' => 'required',
                    'anaesthetist' => 'required',
                    'others' => 'required',
                    'surgery_details' => 'required|max:255',
                ]);
                if ($this->is_movedto_ot && $this->otscheduledata->is_movedto_ot) {
                    $validatedData['is_movedto_ot'] = $this->otscheduledata->is_movedto_ot;
                } else {
                    $validatedData['is_movedto_ot'] = $validate_surgerydetails['is_movedto_ot'] ? Carbon::now() : '';
                    $this->otscheduledata->inpatient->update(['is_movedto_ot' => true]);
                    $bedorroomnumber = Bedorroomnumber::find($this->otscheduledata->bedorroomnumber_id);
                    $bedorroomnumber->update([
                        'is_available' => 1,
                    ]);
                    $bedorroomnumber->bedoccupiable()
                        ->associate($this->otscheduledata)
                        ->save();
                }
                $validatedData['chief_surgeon'] = $validate_surgerydetails['chief_surgeon'];
                $validatedData['senior_surgeon'] = $validate_surgerydetails['senior_surgeon'];
                $validatedData['asst_surgeon'] = $validate_surgerydetails['asst_surgeon'];
                $validatedData['nursing_asst'] = $validate_surgerydetails['nursing_asst'];
                $validatedData['anaesthetist'] = $validate_surgerydetails['anaesthetist'];
                $validatedData['others'] = $validate_surgerydetails['others'];
                $validatedData['surgery_details'] = $validate_surgerydetails['surgery_details'];
                $otschedule = $this->otscheduledata;
                $otschedule->update($validatedData);
                $user->otscheduleupdatable()->save($otschedule);

                Helper::trackmessage($user, $otschedule, 'otschedule_createoredit', session()->getId(), 'WEB', 'OT Surgery details Updated');
                $this->toaster('success', 'OT Surgery details Updated Successfully!!');

            } else {
                $validatedData['patient_id'] = $this->inpatient->patient_id;
                $validatedData['inpatient_id'] = $this->inpatient->id;
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
            return redirect()->route('otschedulelist');
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
        return view('livewire.admin.operationtheatre.otschedule.otschedulelivewire');
    }
}
