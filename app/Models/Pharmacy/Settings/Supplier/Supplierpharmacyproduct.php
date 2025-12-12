<?php

namespace App\Models\Pharmacy\Settings\Supplier;

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplierpharmacyproduct extends Model
{
    use SoftDeletes;

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

    public function pharmacyproduct()
    {
        return $this->belongsTo(Pharmacyproduct::class);
    }
}
