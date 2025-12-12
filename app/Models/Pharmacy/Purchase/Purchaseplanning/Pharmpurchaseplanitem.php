<?php

namespace App\Models\Pharmacy\Purchase\Purchaseplanning;

use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;

class Pharmpurchaseplanitem extends Model
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
}
