<?php

namespace App\Models\Pharmacy\Sales\Salesreturn;

use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentryitem;
use App\Models\Pharmacy\Sales\Salesreturn\Pharmsalesreturn;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;

class Pharmsalesreturnitem extends Model
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

    public function pharmsalesentryitem()
    {
        return $this->belongsTo(Pharmsalesentryitem::class);
    }

    public function pharmsalesreturn()
    {
        return $this->belongsTo(Pharmsalesreturn::class);
    }
}
