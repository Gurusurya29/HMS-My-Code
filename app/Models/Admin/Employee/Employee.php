<?php

namespace App\Models\Admin\Employee;

use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Employee extends Authenticatable
{
    use Notifiable, SoftDeletes, HasAuthTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone', 'avatar', 'dob', 'doj', 'education_qualification', 'previous_organisation', 'experience', 'aadhar_no', 'pan_no',
        'bank_name', 'bank_account_no', 'is_accountactive', 'active', 'bank_ifsc_code', 'bank_branch', 'note', 'updatable_id', 'updatable_type'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->api_token = Str::random(40);
            $model->usertype = 'EMPLOYEE';
            Helper::laboratoryautogenerateid(6, 'E', $model);
        });
    }

    public function paymentable()
    {
        return $this->morphMany(Paymentvoucher::class, 'paymentable');
    }
}
