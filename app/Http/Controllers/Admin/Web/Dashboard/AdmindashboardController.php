<?php

namespace App\Http\Controllers\Admin\Web\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Patient\Auth\Patient;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Outpatient\Outpatient;
use App\Models\Admin\Settings\Doctorsetting\Doctor;

class AdmindashboardController extends Controller
{

    public function dashboard()
    {
        if (!auth()->user()->can('Dashboard')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
        }

        $totalpatientregistration = Patient::where('active', true)->count();
        $totaloutpatient = Outpatient::where('active', true)->count();
        $totalinpatient = Inpatient::where('active', true)->count();
        $totaldoctor = Doctor::where('active', true)->count();

        foreach (Collection::times(7) as $value) {
            $value = $value - 1;
            $chat[$value]['date'] = Carbon::now()->subDay($value)->format('d-m-Y');
            $chat[$value]['newpatient'] = Patient::where('active', true)->whereDate('created_at', Carbon::now()->subDay($value))->count();
            $chat[$value]['outpatient'] = Outpatient::where('active', true)->whereDate('created_at', Carbon::now()->subDay($value))->count();
            $chat[$value]['inpatient'] = Inpatient::where('active', true)->whereDate('created_at', Carbon::now()->subDay($value))->count();
        }

        return view('admin.dashboard.admindashboard',
            compact('totalpatientregistration', 'totaloutpatient', 'totalinpatient', 'totaldoctor', 'chat'));
    }

    public function humanresource()
    {
        if (!auth()->user()->can('Humanresource')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }

        return view('admin.dashboard.humanresource');
    }

}
