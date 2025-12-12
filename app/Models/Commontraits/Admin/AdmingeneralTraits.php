<?php

namespace App\Models\Commontraits\Admin;

use App\Models\Admin\Settings\Tracking\Tracking;

trait AdmingeneralTraits
{
    public function creatable()
    {
        return $this->morphTo();
    }

    public function updatable()
    {
        return $this->morphTo();
    }

    public function functionable()
    {
        return $this->morphMany(Tracking::class, 'functionable');
    }
}
