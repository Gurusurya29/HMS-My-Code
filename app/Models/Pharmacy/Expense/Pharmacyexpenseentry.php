<?php

namespace App\Models\Pharmacy\Expense;

use App\Models\Commontraits\Pharmacy\PharmacybootTraits;
use App\Models\Commontraits\Pharmacy\PharmacygeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Pharmacyexpenseentry extends Model
{

    use PharmacybootTraits, PharmacygeneralTraits;

    public static $prefix = [6, 'EE'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

}
