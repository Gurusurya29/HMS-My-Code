<?php

namespace App\Models\Admin\Outpatient\Dental;

use App\Models\Admin\Outpatient\Outpatient;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Opdental extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'DEN'];

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

    public function patientvisit()
    {
        return $this->belongsTo(Patientvisit::class);
    }

    public function specialable()
    {
        return $this->morphMany(Outpatient::class, 'specialable');
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

}
