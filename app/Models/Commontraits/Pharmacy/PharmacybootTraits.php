<?php

namespace App\Models\Commontraits\Pharmacy;

use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;

trait PharmacybootTraits
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Helper::pharmacyautogenerateid(self::$prefix[0], self::$prefix[1], $model);
        });
        static::updating(function ($model) {
            Helper::pharmacyautogenerateid(false, false, $model);
        });
    }
}
