<?php

namespace App\Models\Admin\Prescription;

use App\Models\Admin\Prescription\Prescription;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Illuminate\Database\Eloquent\Model;

class Prescriptionlist extends Model
{
    use AdmingeneralTraits;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function pharmacyproduct()
    {
        return $this->belongsTo(Pharmacyproduct::class);
    }
}
