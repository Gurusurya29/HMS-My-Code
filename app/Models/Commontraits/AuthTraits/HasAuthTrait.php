<?php

namespace App\Models\Commontraits\AuthTraits;

use App\Models\Admin\Settings\Tracking\Logininfo;
use App\Models\Admin\Settings\Tracking\Tracking;
use App\Models\Miscellaneous\PasswordSecurity;
use Cache;
use Hash;

trait HasAuthTrait
{
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->uuid);
    }

    public function passwordSecurity()
    {
        return $this->hasOne(PasswordSecurity::class);
    }

    public function trackable()
    {
        return $this->morphMany(Tracking::class, 'trackable');
    }

    public function functionable()
    {
        return $this->morphMany(Tracking::class, 'functionable');
    }

    public function logininfoable()
    {
        return $this->morphMany(Logininfo::class, 'logininfoable');
    }

    public function creatable()
    {
        return $this->morphTo();
    }

    public function updatable()
    {
        return $this->morphTo();
    }
}
