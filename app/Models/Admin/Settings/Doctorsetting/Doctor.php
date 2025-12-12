<?php

namespace App\Models\Admin\Settings\Doctorsetting;

use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'D'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function patientvisit()
    {
        return $this->hasMany(Patientvisit::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function doctorspecialization()
    {
        return $this->belongsTo(Doctorspecialization::class);
    }
}
