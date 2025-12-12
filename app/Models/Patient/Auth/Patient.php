<?php

namespace App\Models\Patient\Auth;

use App\Models\Admin\Account\Hospital\Hospitalstatement;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use SoftDeletes, AdmingeneralTraits;

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
            Helper::patientautogenerateid(6, 'P', 'UHID', 'PI', $model);
            $model->usertype = 'PATIENT';
        });
        static::updating(function ($model) {
            Helper::patientautogenerateid(false, false, false, false, $model);
        });
    }

    public function patientvisit()
    {
        return $this->hasMany(Patientvisit::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function userable()
    {
        return $this->morphMany(Hospitalstatement::class, 'userable');
    }

    public function paymentable()
    {
        return $this->morphMany(Paymentvoucher::class, 'paymentable');
    }
}
