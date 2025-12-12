<?php

namespace App\Models\Admin\Settings\Ipsetting;

use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Ipservicecategory extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'IPSC'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

}
