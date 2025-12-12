<?php

namespace App\Models\Admin\Account\Hospital;

use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Hospitalstatement extends Model
{
    use AdmingeneralTraits;

    public static $prefix = [6, 'HS'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function userable()
    {
        return $this->morphTo();
    }

    public function hstatementable()
    {
        return $this->morphTo();
    }

}
