<?php

namespace App\Models\Pharmacy\Purchase\Purchasereturn;

use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Purchase\Purchasereturn\Pharmpurchasereturn;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;

class Purchasereturnitem extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function pharmacyproduct()
    {
        return $this->belongsTo(Pharmacyproduct::class);
    }

    public function pharmpurchaseentryitem()
    {
        return $this->belongsTo(Pharmpurchaseentryitem::class);
    }

    public function pharmpurchasereturn()
    {
        return $this->belongsTo(Pharmpurchasereturn::class);
    }
}
