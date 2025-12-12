<?php

namespace App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labreporttemplate;

use App\Http\Controllers\Controller;

class LabreporttemplateController extends Controller
{
    public function index()
    {
        return view('laboratory.settings.laboratorymaster.labreporttemplate.index');
    }
}
