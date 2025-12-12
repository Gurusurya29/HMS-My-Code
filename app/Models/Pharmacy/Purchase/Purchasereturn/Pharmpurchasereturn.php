<?php

namespace App\Models\Pharmacy\Purchase\Purchasereturn;

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use App\Models\Pharmacy\Purchase\Purchasereturn\Purchasereturnitem;
use Illuminate\Database\Eloquent\Model;

class Pharmpurchasereturn extends Model
{
    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'PURR'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchasereturnitem()
    {
        return $this->hasMany(Purchasereturnitem::class);
    }
}
