<?php

namespace App\Models\Laboratory\Auth;

use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Commontraits\CommontrackingTraits\AdmintrackingTraits;
use App\Models\Commontraits\CommontrackingTraits\LaboratorytrackingTraits;
use App\Models\Commontraits\CommontrackingTraits\PatienttrackingTraits;
use App\Models\Laboratory\Auth\Laboratory;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Laboratory extends Authenticatable
{
    use Notifiable, SoftDeletes, HasAuthTrait, HasRoles, LaboratorytrackingTraits, PatienttrackingTraits, AdmintrackingTraits;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password', 'phone',
        'avatar', 'note', 'updatable_id', 'updatable_type', 'role',
        'access_lab', 'access_scan', 'access_xray'];

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
            $model->usertype = 'LABORATORY';
            Helper::laboratoryautogenerateid(7, 'L', $model);
        });

        // self::updating(function ($model) {
        //     $model->updated_id = auth()->guard('laboratory')->user()->id;
        // });
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
