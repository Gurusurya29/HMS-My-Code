<?php

namespace App\Models\Admin\Patient;

use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Patientregisterationsetting\Reference;
use App\Models\Admin\Settings\Patientvisitsetting\Allergymaster;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patientvisit extends Model
{
    use AdmingeneralTraits, SoftDeletes;

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
            Helper::patientvisitautogenerateid(6, 4, 'PV', $model);
        });
        static::updating(function ($model) {
            Helper::patientvisitautogenerateid(false, false, false, $model);
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function opbilling()
    {
        return $this->hasMany(Opbilling::class);
    }

    public function visitable()
    {
        return $this->morphTo();
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function doctorspecialization()
    {
        return $this->belongsTo(Doctorspecialization::class);
    }

    // Allergy
    public function allergymaster()
    {
        return $this->belongsToMany(Allergymaster::class)->withTimestamps();
    }

    public function getAllergySelectAttribute()
    {
        return $this->allergymaster->pluck('id');
    }

    // Currentcomplaints
    public function currentcomplaints()
    {
        return $this->belongsToMany(Currentcomplaints::class)->withTimestamps();
    }

    public function getCurrentcomplaintsSelectAttribute()
    {
        return $this->currentcomplaints->pluck('id');
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }

    public function wardtype()
    {
        return $this->belongsTo(Wardtype::class);
    }

    public function insurancecompany()
    {
        return $this->belongsTo(Insurancecompany::class);
    }
}
