<?php

namespace App\Models\Admin\Wardmanagement\Bedorroom;

use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Blockbedorroomhistory extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'B'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];
}
