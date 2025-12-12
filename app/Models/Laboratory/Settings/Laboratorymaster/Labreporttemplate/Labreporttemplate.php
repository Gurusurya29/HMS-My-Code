<?php

namespace App\Models\Laboratory\Settings\Laboratorymaster\Labreporttemplate;

use App\Models\Commontraits\Laboratory\LaboratorybootTraits;
use App\Models\Commontraits\Laboratory\LaboratorygeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Labreporttemplate extends Model
{
    use LaboratorybootTraits, LaboratorygeneralTraits;

    public static $prefix = [6, 'LRT'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];
}
