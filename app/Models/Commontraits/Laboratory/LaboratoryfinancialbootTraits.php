<?php

namespace App\Models\Commontraits\Laboratory;

use App\Models\Miscellaneous\Financialhelper;
use Illuminate\Database\Eloquent\SoftDeletes;

trait LaboratoryfinancialbootTraits
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Financialhelper::investigationautogenerateid(self::$prefix[0], self::$prefix[1], $model);
        });
        static::updating(function ($model) {
            Financialhelper::investigationautogenerateid(false, false, $model);
        });
    }
}
