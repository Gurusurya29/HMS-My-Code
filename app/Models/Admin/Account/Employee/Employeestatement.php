<?php

namespace App\Models\Admin\Account\Employee;

use App\Models\Admin\Employee\Employee;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Employeestatement extends Model
{
    use AdmingeneralTraits;

    public static $prefix = [6, 'ES'];

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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
