<?php

namespace App\Models\Laboratory\Laboratory;

use App\Models\Commontraits\Laboratory\LaboratorybootTraits;
use App\Models\Commontraits\Laboratory\LaboratorygeneralTraits;
use App\Models\Laboratory\Laboratory\Labpatient;
use Illuminate\Database\Eloquent\Model;

class Labpatientlist extends Model
{
    use LaboratorybootTraits, LaboratorygeneralTraits;

    public static $prefix = [6, 'LPL'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function labpatient()
    {
        return $this->belongsTo(Labpatient::class, );
    }

}
