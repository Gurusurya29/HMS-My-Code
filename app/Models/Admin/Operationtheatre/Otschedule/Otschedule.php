<?php

namespace App\Models\Admin\Operationtheatre\Otschedule;

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otsurgerynote\Otsurgerypostop;
use App\Models\Admin\Operationtheatre\Otsurgerynote\Otsurgerypreop;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Otschedule extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'OT'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    protected $appends = ['start', 'end', 'title'];
    public function getStartAttribute()
    {
        return Carbon::parse($this->surgery_startdate);
    }

    public function getEndAttribute()
    {
        return Carbon::parse($this->surgery_enddate);
    }

    public function getTitleAttribute()
    {
        return $this->surgery_name;
    }

    // public function getScheduledDateAttribute($date)
    // {
    //     if ($date) {
    //         return Carbon::parse($date)->format('d/m/Y');
    //     } else {
    //         return '';
    //     }
    // }

    // public function getScheduledDateAttribute($date)
    // {
    //     if ($date) {
    //         return Carbon::parse($date)->format('d/m/Y');
    //     } else {
    //         return '';
    //     }
    // }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function inpatient()
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function otsurgerypreop()
    {
        return $this->hasOne(Otsurgerypreop::class);
    }

    public function otsurgerypostop()
    {
        return $this->hasOne(Otsurgerypostop::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function wardtype()
    {
        return $this->belongsTo(Wardtype::class);
    }

    public function bedorroomnumber()
    {
        return $this->belongsTo(Bedorroomnumber::class);
    }
}
