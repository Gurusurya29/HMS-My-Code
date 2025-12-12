<?php

namespace App\Models\Laboratory\Scan;

use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Commontraits\Laboratory\LaboratoryfinancialbootTraits;
use App\Models\Commontraits\Laboratory\LaboratorygeneralTraits;
use App\Models\Laboratory\Scan\Scanpatientlist;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Scanpatient extends Model
{
    use LaboratoryfinancialbootTraits, LaboratorygeneralTraits;

    public static $prefix = [6, 'ENH-SB-'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function scanable()
    {
        return $this->morphTo();
    }

    public function scanpatientlist()
    {
        return $this->hasMany(Scanpatientlist::class, );
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
