<?php

namespace App\Http\Controllers\Admin\Web\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipassesment;

class InpatientController extends Controller
{
    public function inpatientqueue()
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.inpatientqueue.inpatientqueue');
    }

    public function inpatientadmission($inpatient_uuid)
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list') || !auth()->user()->can('Inpatient-admission')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.inpatientadmission.inpatientadmissiongeneral.index',
            compact('inpatient_uuid'));

    }

    public function ipnursingstationservice($uuid)
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list') || !auth()->user()->can('Inpatient-nursingstation')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        $inpatient_uuid = $uuid;

        return view('admin.inpatient.ipnursingstation.ipnursingstationservice.ipnursingstationservice',
            compact('inpatient_uuid'));
    }

    public function ipassesment($inpatient_uuid, $ipassesment_uuid = null)
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list') && !auth()->user()->can('Inpatient-nursingstation') || !auth()->user()->can('IP-assesment')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.ipnursingstation.ipassesment.ipassesment',
            compact('inpatient_uuid', 'ipassesment_uuid'));
    }

    public function ippatienttransfer($inpatient_uuid)
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list') && !auth()->user()->can('Inpatient-nursingstation') || !auth()->user()->can('IP-patienttransfer')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.ipnursingstation.ippatienttransfer.ippatienttransfer',
            compact('inpatient_uuid'));
    }

    public function inpatientdischarge($inpatient_uuid)
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list') || !auth()->user()->can('Inpatient-discharge')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        $inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        switch ($inpatient->ipadmission->doctorspecialization_id) {
            case 1: // General
                return view('admin.inpatient.inpatientdischarge.ipgeneraldischarge.ipgeneraldischarge',
                    compact('inpatient_uuid'));
            case 2: // Gynecologist
                return view('admin.inpatient.inpatientdischarge.ipgynecologydischarge.ipgynecologydischarge',
                    compact('inpatient_uuid'));
            case 3: // Orthopedic
                return view('admin.inpatient.inpatientdischarge.iporthopedicdischarge.iporthopedicdischarge',
                    compact('inpatient_uuid'));
            case 4: // Dermatology
                return view('admin.inpatient.inpatientdischarge.ipdermatologydischarge.ipdermatologydischarge',
                    compact('inpatient_uuid'));
            case 5: // Urology
                return view('admin.inpatient.inpatientdischarge.ipurologydischarge.ipurologydischarge',
                    compact('inpatient_uuid'));
            case 6: // Diabetology
                return view('admin.inpatient.inpatientdischarge.ipdiabetologydischarge.ipdiabetologydischarge',
                    compact('inpatient_uuid'));
            case 7: // Cardiology
                return view('admin.inpatient.inpatientdischarge.ipcardiologydischarge.ipcardiologydischarge',
                    compact('inpatient_uuid'));
            case 8: // Paediatric
                return view('admin.inpatient.inpatientdischarge.ippaediatricdischarge.ippaediatricdischarge',
                    compact('inpatient_uuid'));
            case 9: // Ophthalmology
                return view('admin.inpatient.inpatientdischarge.ipophthalmologydischarge.ipophthalmologydischarge',
                    compact('inpatient_uuid'));
            case 10: // Neurology
                return view('admin.inpatient.inpatientdischarge.ipneurologydischarge.ipneurologydischarge',
                    compact('inpatient_uuid'));
            case 11: // Nephrology
                return view('admin.inpatient.inpatientdischarge.ipnephrologydischarge.ipnephrologydischarge',
                    compact('inpatient_uuid'));
            case 12: // Anesthesiology
                return view('admin.inpatient.inpatientdischarge.ipanesthesiologydischarge.ipanesthesiologydischarge',
                    compact('inpatient_uuid'));
            case 13: // Sonology
                return view('admin.inpatient.inpatientdischarge.ipsonologydischarge.ipsonologydischarge',
                    compact('inpatient_uuid'));
            case 14: // Gastro
                return view('admin.inpatient.inpatientdischarge.ipgastrodischarge.ipgastrodischarge',
                    compact('inpatient_uuid'));
            case 15: // Dental
                return view('admin.inpatient.inpatientdischarge.ipdentaldischarge.ipdentaldischarge',
                    compact('inpatient_uuid'));
            case 16: // General Surgeon
                return view('admin.inpatient.inpatientdischarge.ipgeneralsurgeondischarge.ipgeneralsurgeondischarge',
                    compact('inpatient_uuid'));
            default:
                return "Under Constrution";
        }

    }

    public function ipscheduleotlist($inpatient_uuid)
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list') && !auth()->user()->can('Inpatient-nursingstation') || !auth()->user()->can('IP-otschedule')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.ipnursingstation.ipscheduleot.ipscheduleotlist',
            compact('inpatient_uuid'));
    }

    public function ipscheduleot($inpatient_uuid, $otschedule_uuid = null)
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-list') && !auth()->user()->can('Inpatient-nursingstation') || !auth()->user()->can('IP-otschedule')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.ipnursingstation.ipscheduleot.ipscheduleot',
            compact('inpatient_uuid', 'otschedule_uuid'));
    }

    public function inpatientvisitentry()
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-visitentry')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.inpatientvisitentry.inpatientvisitentry');
    }

    public function inpatienthistory()
    {
        if (!auth()->user()->can('Inpatient') && !auth()->user()->can('Inpatient-history')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.inpatient.inpatienthistory.inpatienthistory');
    }
    public function printdischargesummary(Inpatient $inpatient)
    {
        switch ($inpatient->ipadmission->doctorspecialization_id) {
            case 1: // General
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsgeneralprint',
                    compact('inpatient'));
            case 2: // Gynecologist
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsgynecologyprint',
                    compact('inpatient'));
            case 3: // Orthopedic
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsorthopedicprint',
                    compact('inpatient'));
            case 4: // Dermatology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsdermatologyprint',
                    compact('inpatient'));
            case 5: // Urology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsurologyprint',
                    compact('inpatient'));
            case 6: // Diabetology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsdiabetologyprint',
                    compact('inpatient'));
            case 7: // Cardiology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dscardiologyprint',
                    compact('inpatient'));
            case 8: // Paediatric
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dspaediatricprint',
                    compact('inpatient'));
            case 9: // Ophthalmology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsophthalmologyprint',
                    compact('inpatient'));
            case 10: // Neurology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsneurologyprint',
                    compact('inpatient'));
            case 11: // Nephrology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsnephrologyprint',
                    compact('inpatient'));
            case 12: // Anesthesiology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsanesthesiologyprint',
                    compact('inpatient'));
            case 13: // Sonology
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dssonologyprint',
                    compact('inpatient'));
            case 14: // Gastro
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsgastroprint',
                    compact('inpatient'));
            case 15: // Dental
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsdentalprint',
                    compact('inpatient'));
            case 16: // General Surgeon
                return view('admin.inpatient.inpatienthistory.dischargesummaryprint.dsgeneralsurgeonprint',
                    compact('inpatient'));
            default:
                return "Under Constrution";
        }
    }
    public function printipbarcode(Inpatient $inpatient)
    {
        return view('admin.inpatient.inpatientqueue.printipbarcode', compact('inpatient'));
    }

    public function printipprescription(Ipassesment $ipassessment)
    {
        return view('admin.inpatient.ipnursingstation.ipnursingstationservice.ipprescriptionprint', compact('ipassessment'));
    }

    public function printipinvestigation(Ipassesment $ipassessment)
    {
        $labpatient = $ipassessment->labable;
        $scanpatient = $ipassessment->scanable;
        $xraypatient = $ipassessment->xrayable;
        return view('admin.inpatient.ipnursingstation.ipnursingstationservice.ipinvestigationprint', compact('ipassessment', 'labpatient', 'scanpatient', 'xraypatient'));
    }
    public function printipinvestigationresult(Ipassesment $ipassessment)
    {
        $labpatient = $ipassessment->labable;
        $scanpatient = $ipassessment->scanable;
        $xraypatient = $ipassessment->xrayable;
        return view('admin.inpatient.ipnursingstation.ipnursingstationservice.ipinvestigationresultprint', compact('ipassessment', 'labpatient', 'scanpatient', 'xraypatient'));
    }

    public function ipassesmentlist($uuid)
    {
        return view('admin.inpatient.ipassesmentlist.ipassesmentlist', compact('uuid'));
    }

    public function ipotscheduledlist($uuid)
    {
        return view('admin.inpatient.ipotscheduledlist.ipotscheduledlist', compact('uuid'));
    }
}
