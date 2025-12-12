<?php

namespace App\Models\Admin\Operationtheatre\Otsurgerynote;

use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Otsurgerypreop extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'OTSPR'];

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

    public function inpatient()
    {
        return $this->belongsTo(Inpatient::class);
    }

    public function otschedule()
    {
        return $this->belongsTo(Otschedule::class);
    }
}
