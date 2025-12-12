<?php

namespace App\Models\Admin\Inpatient;

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Prescription\Prescription;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Scan\Scanpatient;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
use App\Models\Laboratory\Xray\Xraypatient;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Ipassesment extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'IPA'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // public function doctorspecialization()
    // {
    //     return $this->belongsTo(Doctorspecialization::class);
    // }

    public function inpatient()
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function patientvisit()
    {
        return $this->belongsTo(Patientvisit::class);
    }

    public function labable()
    {
        return $this->morphOne(Labpatient::class, 'labable');
    }

    public function scanable()
    {
        return $this->morphOne(Scanpatient::class, 'scanable');
    }

    public function xrayable()
    {
        return $this->morphOne(Xraypatient::class, 'xrayable');
    }

    // Current Complaints
    public function currentcomplaints()
    {
        return $this->belongsToMany(Currentcomplaints::class)->withTimestamps();
    }

    public function getCurrentcomplaintsSelectAttribute()
    {
        return $this->currentcomplaints->pluck('id');
    }

    // Physical Exam
    public function physicalexam()
    {
        return $this->belongsToMany(Physicalexam::class)->withTimestamps();
    }

    public function getPhysicalexamSelectAttribute()
    {
        return $this->physicalexam->pluck('id');
    }

    // Diagnosis Master
    public function diagnosismaster()
    {
        return $this->belongsToMany(Diagnosismaster::class)->withTimestamps();
    }

    public function getDiagnosismasterSelectAttribute()
    {
        return $this->diagnosismaster->pluck('id');
    }

    // Lab Investigation
    public function labinvestigation()
    {
        return $this->belongsToMany(Labinvestigation::class)->withTimestamps();
    }

    public function getLabinvestigationSelectAttribute()
    {
        return $this->labinvestigation->pluck('id');
    }

    // Scan Investigation
    public function scaninvestigation()
    {
        return $this->belongsToMany(Labinvestigation::class, 'scaninvestigation_ipassesment')->withTimestamps();
    }

    public function getScaninvestigationSelectAttribute()
    {
        return $this->scaninvestigation->pluck('id');
    }

    // Xray Investigation
    public function xrayinvestigation()
    {
        return $this->belongsToMany(Labinvestigation::class, 'xrayinvestigation_ipassesment')->withTimestamps();
    }

    public function getXrayinvestigationSelectAttribute()
    {
        return $this->xrayinvestigation->pluck('id');
    }

    public function subprescriptionable()
    {
        return $this->morphOne(Prescription::class, 'subprescriptionable');
    }
}
