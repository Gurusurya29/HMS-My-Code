<?php

namespace App\Models\Commontraits\Admin;

use App\Models\Miscellaneous\Financialhelper;
use Illuminate\Database\Eloquent\SoftDeletes;

trait AdminfinancialbootTraits
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Financialhelper::hmsautogenerateid(self::$prefix[0], self::$prefix[1], $model);
        });
        static::updating(function ($model) {
            Financialhelper::hmsautogenerateid(false, false, $model);
        });
    }
}
