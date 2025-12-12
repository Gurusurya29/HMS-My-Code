<?php

namespace App\Models\Admin\Settings\Wardsetting;

use App\Models\Admin\Settings\Wardsetting\Wardfloor;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Admin\Wardmanagement\Bedorroom\Blockbedorroomhistory;
use App\Models\Admin\Wardmanagement\Housekeeping\Housekeepinghistory;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Bedorroomnumber extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'R'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function wardtype()
    {
        return $this->belongsTo(Wardtype::class);
    }

    public function wardfloor()
    {
        return $this->belongsTo(Wardfloor::class);
    }

    public function housekeepinghistory()
    {
        return $this->hasMany(Housekeepinghistory::class);
    }

    public function blockbedorroomhistory()
    {
        return $this->hasMany(Blockbedorroomhistory::class);
    }

    public function bedoccupiable()
    {
        return $this->morphTo();
    }
}
