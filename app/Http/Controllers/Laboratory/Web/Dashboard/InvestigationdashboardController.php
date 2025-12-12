<?php

namespace App\Http\Controllers\Laboratory\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Laboratory\Laboratory\Labpatient;
use App\Models\Laboratory\Scan\Scanpatient;
use App\Models\Laboratory\Xray\Xraypatient;

class InvestigationdashboardController extends Controller
{
    public function dashboard()
    {
        $labpatient = Labpatient::count();
        $xraypatient = Xraypatient::count();
        $scanpatient = Scanpatient::count();

        return view('laboratory.dashboard.investigationdashboard',
            compact('labpatient', 'xraypatient', 'scanpatient'));
    }

}
