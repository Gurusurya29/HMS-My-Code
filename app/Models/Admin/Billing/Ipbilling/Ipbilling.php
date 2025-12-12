<?php

namespace App\Models\Admin\Billing\Ipbilling;

use App\Models\Admin\Billing\Billdiscount\Billdiscount;
use App\Models\Admin\Billing\Ipbilling\Ipbillingservicelist;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Commontraits\Admin\AdminfinancialbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Ipbilling extends Model
{
    use AdminfinancialbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'ENH-IPB-'];

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

    public function inpatient()
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function ipadmission()
    {
        return $this->belongsTo(Ipadmission::class);
    }

    public function patientvisit()
    {
        return $this->belongsTo(Patientvisit::class);
    }

    public function ipbillingservicelist()
    {
        return $this->hasMany(Ipbillingservicelist::class);
    }

    // Receipt
    public function receiptable()
    {
        return $this->morphMany(Receipt::class, 'receiptable');
    }

    public function billdiscountable()
    {
        return $this->morphMany(Billdiscount::class, 'billdiscountable');
    }
}
