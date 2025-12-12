<?php

namespace App\Models\Admin\Account\Supplier;

use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Supplierstatement extends Model
{
    use AdmingeneralTraits;

    public static $prefix = [6, 'SS'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function statementable()
    {
        return $this->morphTo();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
