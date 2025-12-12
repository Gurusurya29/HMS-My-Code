<?php

namespace App\Models\Admin\Settings\Ipsetting;

use App\Models\Admin\Settings\Ipsetting\Ipservicecategory;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Ipservicemaster extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'IPS'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function ipservicecategory()
    {
        return $this->belongsTo(Ipservicecategory::class);
    }
}
