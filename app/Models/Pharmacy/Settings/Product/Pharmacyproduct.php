<?php

namespace App\Models\Pharmacy\Settings\Product;

use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Pharmacy\Settings\Category\Pharmacycategory;
use App\Models\Pharmacy\Settings\Category\Pharmacysubcategory;
use App\Models\Pharmacy\Settings\Drugmaster\Genaric\Pharmacygenaric;
use App\Models\Pharmacy\Settings\Drugmaster\Manufacture\Pharmacymanufacture;
use App\Models\Pharmacy\Settings\Product\Alternativeproduct;
use App\Models\Pharmacy\Settings\Product\Pharmproductinventory;
use Illuminate\Database\Eloquent\Model;

class Pharmacyproduct extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'P'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function pharmacygenaricname()
    {
        return $this->belongsTo(Pharmacygenaric::class, 'pharmacygenaric_id');
    }

    public function pharmacymanufacturename()
    {
        return $this->belongsTo(Pharmacymanufacture::class, 'pharmacymanufacture_id');
    }

    public function pharmacycategoryname()
    {
        return $this->belongsTo(Pharmacycategory::class, 'pharmacycategory_id');
    }

    public function pharmacysubcategoryname()
    {
        return $this->belongsTo(Pharmacysubcategory::class, 'pharmacysubcategory_id');
    }

    public function alternativepharmacyproduct()
    {
        return $this->hasMany(Alternativeproduct::class);
    }

    public function pharmproductinventory()
    {
        return $this->hasMany(Pharmproductinventory::class);
    }
}
