<?php

namespace App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labtestmethod;

use App\Http\Controllers\Controller;

class LabtestmethodController extends Controller
{
    public function index()
    {
        return view('laboratory.settings.laboratorymaster.labtestmethod.index');
    }
}
