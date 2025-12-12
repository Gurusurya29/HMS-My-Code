<?php

namespace App\Http\Livewire\Laboratory\Scan\Patientwalkin;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Scanpatientwalkinlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $last_name, $phone, $email, $sex, $age, $dob, $patient_id, $patient_uhid, $patient_selected;
    public $searchquery, $scaninvestigation, $selectedscaninvestigation = [];
    public $totalscancost = 0;
    public $doctor, $doctor_name, $searchdoctorlist = [];

    public function searchpatient()
    {
        if ($this->patient_selected) {
            $this->searchpatientlist = Patient::where(function ($query) {
                $query->where('name', 'like', '%' . $this->patient_selected . '%')
                    ->orWhere('phone', 'like', '%' . $this->patient_selected . '%')
                    ->orWhere('aadharid', 'like', '%' . $this->patient_selected . '%')
                    ->orWhere('uhid', 'like', '%' . $this->patient_selected . '%');
            })
                ->take(10)
                ->get();
        }
    }

    protected function rules()
    {
        return [
            'doctor_name' => 'required',
        ];
    }

    public function searchdoctor()
    {
        $this->searchdoctorlist = Doctor::where('name', 'like', '%' . $this->doctor_name . '%')
            ->take(10)
            ->get();
    }

    public function selectdoctor($doctor_id)
    {
        $this->doctor = Doctor::find($doctor_id);

        $this->doctor_name = $this->doctor->name;
        $this->searchdoctorlist = [];
    }

    public function searchdoctorfoucs()
    {
        $this->doctor_name = '';
        $this->doctor = null;
    }

    public function selectpatient($patient_id)
    {
        $patient = Patient::find($patient_id);

        $this->patient_id = $patient_id;
        $this->patient_uhid = $patient->uhid;
        $this->name = $patient->name;
        $this->phone = $patient->phone;
        $this->last_name = $patient->last_name;
        $this->email = $patient->email;
        $this->phone = $patient->phone;
        $this->gender = $patient->gender;
        $this->age = $patient->age;
        $this->dob = $patient->dob;
        $this->aadharid = $patient->aadharid;

        $this->patient_selected = [];
        $this->searchpatientlist = [];
    }

    public function searchpatientfoucs()
    {
        $this->patient_selected = [];
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $this->validate();

            $user = auth()->guard('laboratory')->user();

            if ($this->patient_id) {
                $patient = Patient::find($this->patient_id);
                if ($this->doctor) {
                    $doctor = $this->doctor;
                } else {
                    $doctor = $user->adddoctorcreatable()
                        ->create(
                            [
                                'name' => $this->doctor_name,
                                'created_source' => 'Scan',
                            ]
                        );
                }
                $scanpatient = $user->scanpatientcreatable()
                    ->create(
                        [
                            'patient_id' => $patient->id,
                            'doctor_id' => $doctor->id,
                            'maintype' => 'SCAN',
                            'subtype' => 'Scan Walk-in',
                            'total' => collect($this->selectedscaninvestigation)->sum('selffee'),
                            'discount_percentage' => 0,
                            'discount_value' => 0,
                            'grand_total' => collect($this->selectedscaninvestigation)->sum('selffee'),
                        ]
                    );

                foreach ($this->selectedscaninvestigation as $key => $value) {

                    $scaninvestigationdata = Labinvestigation::find($value['labinvestigation_id']);
                    $scanpatientlist = $user->scanpatientlistcreatable()->create(
                        [
                            'labinvestigation_id' => $scaninvestigationdata->id,
                            'scaninvestigation_name' => $scaninvestigationdata->name,
                            'scaninvestigationgroup_name' => $scaninvestigationdata->labinvestigationgroup->name,
                            'units' => $scaninvestigationdata->labunit?->name,
                            'range' => $scaninvestigationdata->range,
                            'testmethod' => $scaninvestigationdata->labtestmethod?->name,
                            'fee' => $scaninvestigationdata->selffee,
                            'selffee' => $scaninvestigationdata->selffee,
                            'insurancefee' => $scaninvestigationdata->insurancefee,
                            'scanpatient_id' => $scanpatient->id,
                        ]);
                }

                Helper::trackmessage($user, $patient, 'patient_createoredit', session()->getId(), 'WEB', 'New Patient Visit Entry');
                $this->toaster('success', 'New Patient Visit Entry Created Successfully!!');
                DB::commit();
                $this->formreset();
            } else {
                DB::rollback();
                $this->toaster('error', 'Please Select Valid Patient Details!!');
            }

        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_patient_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function updatedSearchquery()
    {

        $this->scaninvestigation = Labinvestigation::where('active', true)
            ->whereHas('labinvestigationgroup', fn($q) =>
                $q->where('labinvestigationtype', 2)
            )
            ->whereNotIn('id', collect($this->selectedscaninvestigation)->pluck('labinvestigation_id'))
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchquery . '%');
                $query->orWhere('uniqid', 'like', '%' . $this->searchquery . '%');
            })
            ->take(10)
            ->get()
            ->toArray();

    }

    public function additem(Labinvestigation $scaninvestigation)
    {
        $this->selectedscaninvestigation[] = [
            'patient_id' => $this->patient_id,
            'labinvestigation_id' => $scaninvestigation->id,
            'labinvestigation_name' => $scaninvestigation->name,
            'selffee' => $scaninvestigation->selffee,
        ];

        $this->searchquery = '';
        $this->scaninvestigation = [];
    }

    public function removeitem($key)
    {
        unset($this->selectedscaninvestigation[$key]);
    }

    public function formreset()
    {
        $this->name = $this->last_name = $this->email = $this->phone = $this->gender =
        $this->age = $this->dob = $this->aadharid = $this->patient_uhid = $this->patient_id =
        $this->searchquery = $this->scaninvestigation = $this->doctor = $this->doctor_name = null;
        $this->selectedscaninvestigation = $this->searchdoctorlist = [];

        $this->resetValidation();
    }

    public function render()
    {
        $this->totalscancost = collect($this->selectedscaninvestigation)->sum('selffee');

        return view('livewire.laboratory.scan.patientwalkin.scanpatientwalkinlivewire');
    }
}
