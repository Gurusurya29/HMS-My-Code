<?php

namespace App\Models\Commontraits\Admin;

use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;

trait AdminbootTraits
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Helper::autogenerateid(self::$prefix[0], self::$prefix[1], $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }
}
