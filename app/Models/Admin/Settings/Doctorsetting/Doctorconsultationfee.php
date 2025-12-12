<?php

namespace App\Models\Admin\Settings\Doctorsetting;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Commontraits\Admin\AdminbootTraits;
use App\Models\Commontraits\Admin\AdmingeneralTraits;
use Illuminate\Database\Eloquent\Model;

class Doctorconsultationfee extends Model
{
    use AdminbootTraits, AdmingeneralTraits;

    public static $prefix = [6, 'CF'];

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function doctorspecialization()
    {
        return $this->belongsTo(Doctorspecialization::class);
    }
}
