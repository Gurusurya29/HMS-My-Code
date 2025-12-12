<?php

namespace App\Http\Controllers\Laboratory\Web\Settings\Laboratorymaster\Labinvestigationgroup;

use App\Http\Controllers\Controller;

class LabinvestigationgroupController extends Controller
{
    public function index()
    {
        return view('laboratory.settings.laboratorymaster.labinvestigationgroup.index');
    }
}
