<?php

namespace App\Http\Livewire\Admin\Operationtheatre\Otschedule;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Miscellaneous\Helper;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Otpreopnoteslivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    use WithFileUploads;
    use UploadTrait;

    public $otschedule, $otsurgerypreopdata;
    public $preop_note, $preopadditional_note, $preop_remarks, $is_writtenconsent, $is_betadine,
    $niloral_date, $niloral_time, $res_bloodunits, $res_bloodgroup, $res_blooddate, $res_bloodtime, $patientsent_date,
    $patientsent_time, $anaesthetist, $writtenconsent_file, $tempwrittenconsent_file;

    public function mount($otschedule_uuid)
    {
        $this->otschedule = Otschedule::where('uuid', $otschedule_uuid)->first();
        $this->otsurgerypreopdata = $this->otschedule->otsurgerypreop;
        if ($this->otsurgerypreopdata) {
            $this->preop_note = $this->otsurgerypreopdata->preop_note;
            $this->preopadditional_note = $this->otsurgerypreopdata->preopadditional_note;
            $this->preop_remarks = $this->otsurgerypreopdata->preop_remarks;
            $this->is_writtenconsent = $this->otsurgerypreopdata->is_writtenconsent;
            $this->is_betadine = $this->otsurgerypreopdata->is_betadine;
            $this->niloral_date = $this->otsurgerypreopdata->niloral_date;
            $this->niloral_time = $this->otsurgerypreopdata->niloral_time;
            $this->res_bloodunits = $this->otsurgerypreopdata->res_bloodunits;
            $this->res_bloodgroup = $this->otsurgerypreopdata->res_bloodgroup;
            $this->res_blooddate = $this->otsurgerypreopdata->res_blooddate;
            $this->res_bloodtime = $this->otsurgerypreopdata->res_bloodtime;
            $this->patientsent_date = $this->otsurgerypreopdata->patientsent_date;
            $this->patientsent_time = $this->otsurgerypreopdata->patientsent_time;
            $this->anaesthetist = $this->otsurgerypreopdata->anaesthetist;
            $this->tempwrittenconsent_file = $this->otschedule->writtenconsent_file;
        } else {
            $this->anaesthetist = $this->otschedule->anaesthetist;
            $this->res_blooddate = $this->otschedule->scheduled_date;
            $this->res_bloodtime = Carbon::parse($this->otschedule->start_time)->subMinutes(10)->format('H:i');
            $this->patientsent_date = $this->otschedule->scheduled_date;
            $this->patientsent_time = Carbon::parse($this->otschedule->start_time)->subMinutes(10)->format('H:i');
        }
    }

    protected function rules()
    {
        return [
            'preop_note' => 'required',
            'preopadditional_note' => 'required',
            'preop_remarks' => 'required',
            'is_writtenconsent' => 'required|boolean',
            'is_betadine' => 'required|boolean',
            'niloral_date' => 'required|date',
            'niloral_time' => 'required',
            'res_bloodunits' => 'nullable|numeric|max:100',
            'res_blooddate' => 'nullable|date',
            'res_bloodgroup' => 'nullable',
            'res_bloodtime' => 'nullable',
            'patientsent_date' => 'required|date',
            'patientsent_time' => 'required',
            'anaesthetist' => 'required',
            'writtenconsent_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->otsurgerypreopdata) {
                $otsurgerypreop = $this->otsurgerypreopdata;
                $otsurgerypreop->update($validatedData);
                $user->otsurgerypreopupdatable()->save($otsurgerypreop);
                if ($this->writtenconsent_file) {
                    $writtenconsentfiledata = $this->uploadfile($this->otschedule->id, $this->writtenconsent_file, '/admin/otschedule/' . $this->otschedule->uniqid, 'App\Models\Admin\Operationtheatre\Otschedule\Otschedule', 'writtenconsent_file');
                    $this->otschedule->update(['writtenconsent_file' => $writtenconsentfiledata]);
                }
                Helper::trackmessage($user, $otsurgerypreop, 'otsurgerypreop_createoredit', session()->getId(), 'WEB', 'OT Pre-Op Details Updated');
                $this->toaster('success', 'OT Pre-Op Details Updated Successfully!!');

            } else {
                $preopvalidatedData['patient_id'] = $this->otschedule->patient_id;
                $preopvalidatedData['inpatient_id'] = $this->otschedule->inpatient_id;
                $preopvalidatedData['otschedule_id'] = $this->otschedule->id;

                $preopvalidatedData['preop_note'] = $validatedData['preop_note'];
                $preopvalidatedData['preopadditional_note'] = $validatedData['preopadditional_note'];
                $preopvalidatedData['preop_remarks'] = $validatedData['preop_remarks'];
                $preopvalidatedData['is_writtenconsent'] = $validatedData['is_writtenconsent'];
                $preopvalidatedData['is_betadine'] = $validatedData['is_betadine'];
                $preopvalidatedData['niloral_date'] = $validatedData['niloral_date'];
                $preopvalidatedData['niloral_time'] = $validatedData['niloral_time'];
                $preopvalidatedData['res_bloodunits'] = $validatedData['res_bloodunits'];
                $preopvalidatedData['res_bloodgroup'] = $validatedData['res_bloodgroup'];
                $preopvalidatedData['res_blooddate'] = $validatedData['res_blooddate'];
                $preopvalidatedData['res_bloodtime'] = $validatedData['res_bloodtime'];
                $preopvalidatedData['patientsent_date'] = $validatedData['patientsent_date'];
                $preopvalidatedData['patientsent_time'] = $validatedData['patientsent_time'];
                $preopvalidatedData['anaesthetist'] = $validatedData['anaesthetist'];
                $otsurgerypreop = $user->otsurgerypreopcreatable()
                    ->create($preopvalidatedData);

                if ($this->writtenconsent_file) {
                    $writtenconsentfiledata = $this->uploadfile(null, $this->writtenconsent_file, '/admin/otschedule/' . $this->otschedule->uniqid, 'App\Models\Admin\Operationtheatre\Otschedule\Otschedule', 'writtenconsent_file');
                    $this->otschedule->update(['writtenconsent_file' => $writtenconsentfiledata]);
                }
                Helper::trackmessage($user, $otsurgerypreop, 'otsurgerypreop_createoredit', session()->getId(), 'WEB', 'OT Pre-Op Details Saved');
                $this->toaster('success', 'OT Pre-Op Details Saved Successfully!!');
            }
            DB::commit();
            return redirect()->route('otschedulelist');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_otsurgerypreops_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_otsurgerypreops_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_otsurgerypreops_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.operationtheatre.otschedule.otpreopnoteslivewire');
    }
}
