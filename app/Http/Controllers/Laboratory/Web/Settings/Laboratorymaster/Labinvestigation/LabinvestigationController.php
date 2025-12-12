<?php

namespace App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labinvestigation;

use App\Http\Controllers\Controller;

class LabinvestigationController extends Controller
{
    public function index()
    {
        return view('laboratory.settings.laboratorymaster.labinvestigation.index');
    }
}
