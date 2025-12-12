<?php

namespace App\Models\Pharmacy\Auth;

use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Commontraits\CommontrackingTraits\AdmintrackingTraits;
use App\Models\Commontraits\CommontrackingTraits\PatienttrackingTraits;
use App\Models\Commontraits\CommontrackingTraits\PharmacytrackingTraits;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Auth\Pharmacy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Pharmacy extends Authenticatable
{
    use Notifiable, SoftDeletes, HasAuthTrait, HasRoles, PharmacytrackingTraits, PatienttrackingTraits,
        AdmintrackingTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password', 'phone', 'avatar', 'note', 'role'];

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
            $model->usertype = 'PHARMACY';
            Helper::pharmacyautogenerateid(7, 'P', $model);
        });

        self::updating(function ($model) {
            $model->updated_id = auth()->guard('pharmacy')->user()->id;
        });
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
