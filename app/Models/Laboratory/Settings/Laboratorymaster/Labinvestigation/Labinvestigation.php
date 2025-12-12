<?php

namespace App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation;

use App\Models\Commontraits\Laboratory\LaboratorybootTraits;
use App\Models\Commontraits\Laboratory\LaboratorygeneralTraits;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigationgroup\Labinvestigationgroup;
use App\Models\Laboratory\Settings\Laboratorymaster\Labtestmethod\Labtestmethod;
use App\Models\Laboratory\Settings\Laboratorymaster\Labunit\Labunit;
use Illuminate\Database\Eloquent\Model;

class Labinvestigation extends Model
{
    use LaboratorybootTraits, LaboratorygeneralTraits;

    public static $prefix = [6, 'LIN'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function labinvestigationgroup()
    {
        return $this->belongsTo(Labinvestigationgroup::class);
    }

    public function labunit()
    {
        return $this->belongsTo(Labunit::class);
    }

    public function labtestmethod()
    {
        return $this->belongsTo(Labtestmethod::class);
    }
}
