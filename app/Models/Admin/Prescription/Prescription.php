<?php

namespace App\Models\Admin\Prescription;

use App\Models\Admin\Prescription\Prescriptionlist;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'PR'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function prescriptionlist()
    {
        return $this->hasMany(Prescriptionlist::class);
    }

    public function prescriptionable()
    {
        return $this->morphTo();
    }

    public function subprescriptionable()
    {
        return $this->morphTo();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
