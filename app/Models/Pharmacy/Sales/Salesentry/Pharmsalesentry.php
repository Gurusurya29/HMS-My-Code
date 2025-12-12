<?php

namespace App\Models\Pharmacy\Sales\Salesentry;

use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Miscellaneous\Financialhelper;
use App\Models\Patient\Auth\Patient;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentryitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmsalesentry extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits, SoftDeletes;

    public static $prefix = [6, 'ENH-PHARM-'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Financialhelper::pharmacyautogenerateid(self::$prefix[0], self::$prefix[1], $model);
        });
        static::updating(function ($model) {
            Financialhelper::pharmacyautogenerateid(false, false, $model);
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function pharmsalesentryitem()
    {
        return $this->hasMany(Pharmsalesentryitem::class);
    }
}
