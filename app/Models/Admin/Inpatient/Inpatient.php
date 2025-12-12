<?php

namespace App\Models\Admin\Inpatient;

use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Operationtheatre\Otsurgerynote\Otsurgerypreop;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Prescription\Prescription;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Inpatient extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'IP'];

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

    public function ipadmission()
    {
        return $this->hasOne(Ipadmission::class);
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
        return $this->morphMany(Prescription::class, 'prescriptionable');
    }

    public function dsspecialable()
    {
        return $this->morphTo();
    }
    public function otsurgerypreop()
    {
        return $this->hasMany(Otsurgerypreop::class);
    }
}
