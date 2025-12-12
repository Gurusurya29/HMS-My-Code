<?php

namespace App\Models\Admin\Insurance;

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Patientinsurance extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'P-INS'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        // 'pa_sentdatetime' => 'datetime:d-M-Y h:i:s',
        // 'da_sentdatetime' => 'datetime:d-M-Y h:i:s',
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
        return $this->hasOne(Ipadmission::class);
    }
}
