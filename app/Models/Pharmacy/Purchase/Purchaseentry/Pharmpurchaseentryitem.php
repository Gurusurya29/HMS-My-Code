<?php

namespace App\Models\Pharmacy\Purchase\Purchaseentry;

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentry;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorderitem;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;

class Pharmpurchaseentryitem extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function pharmproduct()
    {
        return $this->belongsTo(Pharmacyproduct::class, 'pharmacyproduct_id');
    }

    public function pharmpurchaseentry()
    {
        return $this->belongsTo(Pharmpurchaseentry::class);
    }

    public function pharmpurchaseorderitem()
    {
        return $this->hasMany(Pharmpurchaseorderitem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
