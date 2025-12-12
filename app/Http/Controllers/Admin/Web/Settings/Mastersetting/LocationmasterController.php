<?php

namespace App\Http\Controllers\Admin\Web\Settings\Mastersetting;

use App\Http\Controllers\Controller;

class LocationmasterController extends Controller
{
    public function locationmaster()
    {
        return view('admin.settings.mastersetting.locationmaster.locationmaster');
    }
}
