<?php

namespace App\Models\Admin\Billing\Opbilling;

use App\Models\Admin\Account\Hospital\Hospitalstatement;
use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Billing\Opbilling\Opbillinglist;
use App\Models\Admin\Billing\Opbilling\Opbillingservicelist;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Opbilling extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'OPB'];

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

    public function opbillinglist()
    {
        return $this->hasMany(Opbillinglist::class);
    }

    public function opbillingservicelist()
    {
        return $this->hasMany(Opbillingservicelist::class);
    }

    public function statementable()
    {
        return $this->morphMany(Patientstatement::class, 'statementable');
    }

    public function hstatementable()
    {
        return $this->morphMany(Hospitalstatement::class, 'hstatementable');
    }

    // Receipt
    public function receiptable()
    {
        return $this->morphMany(Receipt::class, 'receiptable');
    }

}
