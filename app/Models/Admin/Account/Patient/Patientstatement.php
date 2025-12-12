<?php

namespace App\Models\Admin\Account\Patient;

use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Patientstatement extends Model
{
    use AdmingeneralTraits;

    public static $prefix = [6, 'PS'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function statementable()
    {
        return $this->morphTo();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
