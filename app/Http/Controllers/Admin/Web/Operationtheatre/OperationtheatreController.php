<?php

namespace App\Http\Controllers\Admin\Web\Operationtheatre;

use App\Http\Controllers\Controller;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use Response;

class OperationtheatreController extends Controller
{

    public function otcalendar()
    {
        if (!auth()->user()->can('Operationtheatre') && !auth()->user()->can('OT-Calendar')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        if (request()->ajax()) {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');

            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Otschedule::with('doctor')
                ->whereDate('surgery_startdate', '>=', $start)
                ->whereDate('surgery_enddate', '<=', $end)
                ->where('is_otactive', true)
                ->with('patient', 'bedorroomnumber')
                ->get();
            return response()->json($data);
        }

        return view('admin.operationtheatre.otcalendar.otcalendar');
    }

    public function otschedulelist()
    {
        if (!auth()->user()->can('Operationtheatre') && !auth()->user()->can('OT-Schedule')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.operationtheatre.otschedule.otschedulelist');
    }

    public function otscheduling($otschedule_uuid = null)
    {
        if (!auth()->user()->can('Operationtheatre') && !auth()->user()->can('OT-Schedule') && !auth()->user()->can('OT-New_Surgery')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        if (!auth()->user()->can('Operationtheatre') && !auth()->user()->can('OT-Schedule') && !auth()->user()->can('OT-Surgerydetails')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.operationtheatre.otschedule.otschedule', compact('otschedule_uuid'));
    }

    public function otpreopnotes($otschedule_uuid)
    {
        if (!auth()->user()->can('Operationtheatre') && !auth()->user()->can('OT-Schedule') || !auth()->user()->can('OT-Surgerynotes')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.operationtheatre.otschedule.otpreopnotes', compact('otschedule_uuid'));
    }

    public function otpostopnotes($otschedule_uuid)
    {
        if (!auth()->user()->can('Operationtheatre') && !auth()->user()->can('OT-Schedule') || !auth()->user()->can('OT-Surgerynotes')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.operationtheatre.otschedule.otpostopnotes', compact('otschedule_uuid'));
    }

    public function othistory()
    {
        if (!auth()->user()->can('Operationtheatre') && !auth()->user()->can('OT-history')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.operationtheatre.othistory.othistory');
    }

}
