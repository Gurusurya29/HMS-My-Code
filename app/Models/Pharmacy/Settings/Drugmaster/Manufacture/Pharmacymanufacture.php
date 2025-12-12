<?php

namespace App\Models\Pharmacy\Settings\Drugmaster\Manufacture;

use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use Illuminate\Database\Eloquent\Model;

class Pharmacymanufacture extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'MF'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function pharmacycategory()
    {
        return $this->belongsTo(Pharmacycategory::class);
    }
}
