<?php

namespace App\Models\Pharmacy\Settings\Category;

use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use Illuminate\Database\Eloquent\Model;

class Pharmacysubcategory extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'PSC'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function category()
    {
        return $this->belongsTo(Pharmacycategory::class, 'pharmacycategory_id');
    }
}
