<?php

namespace App\Models\Admin\Billing\Opbilling;

use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Opbillingservicelist extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'OPB'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

}
