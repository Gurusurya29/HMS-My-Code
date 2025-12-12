<?php

namespace App\Models\Commontraits\Laboratory;

use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;

trait LaboratorybootTraits
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Helper::laboratoryautogenerateid(self::$prefix[0], self::$prefix[1], $model);
        });
        static::updating(function ($model) {
            Helper::laboratoryautogenerateid(false, false, $model);
        });
    }
}
