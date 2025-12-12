<?php

namespace App\Models\Admin\Auth;

use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Commontraits\CommontrackingTraits\AdmintrackingTraits;
use App\Models\Commontraits\CommontrackingTraits\LaboratorytrackingTraits;
use App\Models\Commontraits\CommontrackingTraits\PatienttrackingTraits;
use App\Models\Commontraits\CommontrackingTraits\PharmacytrackingTraits;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, AdmintrackingTraits, PatienttrackingTraits, LaboratorytrackingTraits, PharmacytrackingTraits;

    use HasAuthTrait;

    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'username', 'role_id', 'email', 'is_accountactive', 'active', 'password', 'phone', 'avatar', 'note'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
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
            $model->usertype = 'ADMIN';
            Helper::autogenerateid(7, 'A', $model);
        });

    }

}
