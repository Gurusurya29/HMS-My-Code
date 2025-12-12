<?php

namespace App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labunit;

use App\Http\Controllers\Controller;

class LabunitController extends Controller
{
    public function index()
    {
        return view('laboratory.settings.laboratorymaster.labunit.index');
    }
}
