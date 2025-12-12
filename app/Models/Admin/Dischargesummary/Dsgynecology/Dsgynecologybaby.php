<?php

namespace App\Models\Admin\Dischargesummary\Dsgynecology;

use App\Models\Admin\Dischargesummary\Dsgynecology\Dsgynecology;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Dsgynecologybaby extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'DSGYB'];

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

    public function dsspecialable()
    {
        return $this->morphMany(Inpatient::class, 'dsspecialable');
    }

    public function dsgynecology()
    {
        return $this->belongsTo(Dsgynecology::class);
    }
}
