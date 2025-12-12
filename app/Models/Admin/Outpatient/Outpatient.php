<?php

namespace App\Models\Admin\Outpatient;

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Prescription\Prescription;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Outpatient extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'OP'];

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

    public function patientvisit()
    {
        return $this->belongsTo(Patientvisit::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function doctorspecialization()
    {
        return $this->belongsTo(Doctorspecialization::class);
    }

    public function visitable()
    {
        return $this->morphOne(Patientvisit::class, 'visitable');
    }

    public function prescriptionable()
    {
        return $this->morphOne(Prescription::class, 'prescriptionable');
    }

    public function specialable()
    {
        return $this->morphTo();
    }

    public function inpatient()
    {
        return $this->hasOne(Inpatient::class);
    }

}
