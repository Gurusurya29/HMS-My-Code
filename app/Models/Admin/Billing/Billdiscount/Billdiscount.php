<?php

namespace App\Models\Admin\Billing\Billdiscount;

use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use App\Models\Patient\Auth\Patient;
use Illuminate\Database\Eloquent\Model;

class Billdiscount extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'BD'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function billdiscountable()
    {
        return $this->morphTo();
    }
}
