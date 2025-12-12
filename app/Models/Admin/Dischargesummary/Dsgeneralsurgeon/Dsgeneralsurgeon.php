<?php

namespace App\Models\Admin\Dischargesummary\Dsgeneralsurgeon;

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Prescription\Prescription;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Dsgeneralsurgeon extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'DSGS'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        'followupvisit' => 'json',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ipadmission()
    {
        return $this->belongsTo(Ipadmission::class);
    }

    public function dsspecialable()
    {
        return $this->morphMany(Inpatient::class, 'dsspecialable');
    }

    public function subprescriptionable()
    {
        return $this->morphOne(Prescription::class, 'subprescriptionable');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
