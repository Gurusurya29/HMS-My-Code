<?php

namespace App\Http\Controllers\Pharmacy\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentry;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use Carbon\Carbon;

class PharmacydashboardController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $totalprods = Pharmacyproduct::count();
        $totalsalestoday = Pharmsalesentry::whereDate('created_at', $today)->count();

        $currentDate = Carbon::now();
        $agoDate = $currentDate->subDays($currentDate->dayOfWeek)->subWeek();
        $nowDate = Carbon::now();

        $totalsalesweek = Pharmsalesentry::whereBetween('created_at', [$agoDate, $nowDate])->count();
        $totalsalesmonth = Pharmsalesentry::whereMonth('created_at', Carbon::now()->month)->count();
        return view('pharmacy.dashboard.pharmacydashboard', compact('totalprods', 'totalsalestoday', 'totalsalesweek', 'totalsalesmonth'));
    }

}
