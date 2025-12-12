<?php

namespace App\Models\Laboratory\Scan;

use App\Models\Commontraits\Laboratory\LaboratorybootTraits;
use App\Models\Commontraits\Laboratory\LaboratorygeneralTraits;
use App\Models\Laboratory\Scan\Scanpatient;
use Illuminate\Database\Eloquent\Model;

class Scanpatientlist extends Model
{

    use LaboratorybootTraits, LaboratorygeneralTraits;

    public static $prefix = [6, 'SPL'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function scanpatient()
    {
        return $this->belongsTo(Scanpatient::class, );
    }
}
