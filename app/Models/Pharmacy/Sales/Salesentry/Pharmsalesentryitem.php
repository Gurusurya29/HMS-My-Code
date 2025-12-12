<?php

namespace App\Models\Pharmacy\Sales\Salesentry;

use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;

class Pharmsalesentryitem extends Model
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

    public function pharmpurchaseentryitem()
    {
        return $this->belongsTo(Pharmpurchaseentryitem::class);
    }

    public function pharmsalesentry()
    {
        return $this->belongsTo(Pharmsalesentry::class);
    }

}
