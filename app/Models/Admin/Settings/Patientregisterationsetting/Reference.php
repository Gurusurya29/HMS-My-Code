<?php

namespace App\Models\Admin\Settings\Patientregisterationsetting;

use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'R'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }
}
