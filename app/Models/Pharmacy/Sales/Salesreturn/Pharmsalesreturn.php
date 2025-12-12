<?php

namespace App\Models\Pharmacy\Sales\Salesreturn;

use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Patient\Auth\Patient;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturnitem;
use Illuminate\Database\Eloquent\Model;

class Pharmsalesreturn extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'PR'];

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

    public function pharmsalesentry()
    {
        return $this->belongsTo(Pharmsalesentry::class);
    }

    public function pharmsalesreturnitem()
    {
        return $this->hasMany(Pharmsalesreturnitem::class);
    }
}
