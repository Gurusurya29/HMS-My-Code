<?php

namespace App\Models\Pharmacy\Settings\Product;

use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternativeproduct extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function alternativepharmacyproduct()
    {
        return $this->belongsTo(Pharmacyproduct::class, 'alternativeproduct_id');
    }
}
