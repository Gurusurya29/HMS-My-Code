<?php

namespace App\Models\Admin\Billing\Opbilling;

use App\Models\Admin\Billing\Billdiscount\Billdiscount;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Billing\Opbilling\Opbillingservicelist;
use App\Models\Commontraits\Admin\AdminfinancialbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Opbillinglist extends Model
{
    use AdminfinancialbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'ENH-OPBL-'];

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

    public function opbilling()
    {
        return $this->belongsTo(Opbilling::class);
    }

    public function opbillingservicelist()
    {
        return $this->hasMany(Opbillingservicelist::class);
    }

    public function billdiscountable()
    {
        return $this->morphMany(Billdiscount::class, 'billdiscountable');
    }

}
