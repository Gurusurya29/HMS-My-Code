<?php

namespace App\Models\Laboratory\Xray;

use App\Models\Commontraits\Laboratory\LaboratorybootTraits;
use App\Models\Commontraits\Laboratory\LaboratorygeneralTraits;
use App\Models\Laboratory\Xray\Xraypatient;
use Illuminate\Database\Eloquent\Model;

class Xraypatientlist extends Model
{

    use LaboratorybootTraits, LaboratorygeneralTraits;

    public static $prefix = [6, 'XPL'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function xraypatient()
    {
        return $this->belongsTo(Xraypatient::class, );
    }
}
