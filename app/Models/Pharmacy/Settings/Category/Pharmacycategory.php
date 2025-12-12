<?php

namespace App\Models\Pharmacy\Settings\Category;

use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Pharmacycategory extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'PC'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];
}
