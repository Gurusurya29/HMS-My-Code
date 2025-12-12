<?php

namespace App\Http\Controllers\Admin\Web\Settings\Generalsetting;

use App\Http\Controllers\Controller;

class ThemesettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function themesetting()
    {
        return view('admin.settings.generalsetting.themesetting.themesetting');
    }

}
