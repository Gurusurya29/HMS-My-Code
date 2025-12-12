<?php

namespace App\Models\Admin\Inpatient;

use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipforeigner;
use App\Models\Admin\Insurance\Patientinsurance;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Ipadmission extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'IPA'];

    protected $dates = ['deleted_at', 'dob'];
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

    public function inpatient()
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function ipbilling()
    {
        return $this->hasOne(Ipbilling::class);
    }

    public function ipforeigner()
    {
        return $this->hasOne(Ipforeigner::class);
    }

    public function patientinsurance()
    {
        return $this->hasOne(Patientinsurance::class);
    }

    public function wardtype()
    {
        return $this->belongsTo(Wardtype::class);
    }

    public function bedorroomnumber()
    {
        return $this->belongsTo(Bedorroomnumber::class);
    }

    public function bedoccupiable()
    {
        return $this->morphOne(Bedorroomnumber::class, 'bedoccupiable');
    }
}
