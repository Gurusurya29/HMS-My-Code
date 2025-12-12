<?php

namespace App\Models\Admin\Settings\Pharmacysetting;

use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Drugmaster extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'D'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];
}
