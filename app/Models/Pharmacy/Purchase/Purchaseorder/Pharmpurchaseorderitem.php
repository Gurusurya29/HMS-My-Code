<?php

namespace App\Models\Pharmacy\Purchase\Purchaseorder;

use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Purchase\Purchaseorder\Pharmpurchaseorder;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;

class Pharmpurchaseorderitem extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function pharmacyproduct()
    {
        return $this->belongsTo(Pharmacyproduct::class, 'pharmacyproduct_id');
    }

    public function pharmpurchaseorder()
    {
        return $this->belongsTo(Pharmpurchaseorder::class);
    }

    public function pruchaseentryitem()
    {
        return $this->hasMany(Pharmpurchaseentryitem::class);
    }

    public function purchasebasedentryitem($pharmpurchaseentryid)
    {
        return Pharmpurchaseentryitem::where('pharmpurchaseorderitem_id', $this->id)
            ->where('pharmpurchaseentry_id', $pharmpurchaseentryid)
            ->get();
    }
}
