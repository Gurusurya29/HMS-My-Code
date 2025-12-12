<?php

namespace App\Http\Controllers\Admin\Web\Outpatient;

use App\Http\Controllers\Controller;
use App\Models\Admin\Outpatient\Outpatient;

class OutpatientController extends Controller
{
    public function outpatientqueue()
    {
        if (!auth()->user()->can('Outpatient') && !auth()->user()->can('Outpatient-list')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.outpatient.outpatientqueue.outpatientqueuelist');
    }

    public function outpatientvisitentry()
    {
        if (!auth()->user()->can('Outpatient') && !auth()->user()->can('Outpatient-visitentry')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.outpatient.outpatientvisitentry.outpatientvisitentry');
    }

    public function outpatienthistory()
    {
        if (!auth()->user()->can('Outpatient') && !auth()->user()->can('Outpatient-history')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        return view('admin.outpatient.outpatienthistory.outpatienthistory');
    }

    public function printprescription(Outpatient $outpatient)
    {
        return view('admin.outpatient.outpatienthistory.prescriptionprint', compact('outpatient'));
    }
    public function printassessment(Outpatient $outpatient)
    {
        switch ($outpatient->doctorspecialization_id) {
            case 1: // General
                return view('admin.outpatient.outpatienthistory.opassessmentprint.outpatientgeneralassessmentprint', compact('outpatient'));
                break;
            case 2: // Gynecologist
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentgynecologistprint', compact('outpatient'));
                break;
            case 3: // Orthopedic
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentorthopedicprint', compact('outpatient'));
                break;
            case 4: // Dermatology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentdermatologyprint', compact('outpatient'));
                break;
            case 5: // Urology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmenturologyprint', compact('outpatient'));
                break;
            case 6: // Diabetology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentdiabetologyprint', compact('outpatient'));
                break;
            case 7: // Cardiology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentcardiologyprint', compact('outpatient'));
                break;
            case 8: // Paediatric
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentpaediatricprint', compact('outpatient'));
                break;
            case 9: // Ophthalmology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentophthalmologyprint', compact('outpatient'));
                break;
            case 10: //Neurology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentneurologyprint', compact('outpatient'));
                break;
            case 11: //Nephrology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentnephrologyprint', compact('outpatient'));
                break;
            case 12: //Anesthesiology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentanesthesiologyprint', compact('outpatient'));
                break;
            case 13: //Sonology
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentsonologyprint', compact('outpatient'));
                break;
            case 14: //Gastro
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentgastroprint', compact('outpatient'));
            case 15: //Dental
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentdentalprint', compact('outpatient'));
                break;
            case 16: //General Surgeon
                return view('admin.outpatient.outpatienthistory.opassessmentprint.opassessmentgeneralsurgeonprint', compact('outpatient'));
                break;
            default:
                return "Under Constrution";
        }

    }

    public function opprintinvestigation(Outpatient $outpatient)
    {
        $labpatient = $outpatient->specialable->labable;
        $scanpatient = $outpatient->specialable->scanable;
        $xraypatient = $outpatient->specialable->xrayable;

        return view('admin.outpatient.outpatienthistory.opinvestigationprint',
            compact('outpatient', 'labpatient', 'scanpatient', 'xraypatient'));
    }

    public function opprintinvestigationresult(Outpatient $outpatient)
    {
        $labpatient = $outpatient->specialable->labable;
        $scanpatient = $outpatient->specialable->scanable;
        $xraypatient = $outpatient->specialable->xrayable;

        return view('admin.outpatient.outpatienthistory.opinvestigationresultprint',
            compact('outpatient', 'labpatient', 'scanpatient', 'xraypatient'));
    }

    public function opassessment($uuid, $requesttype = null)
    {
        if (!auth()->user()->can('Outpatient') && !auth()->user()->can('Outpatient-list') || !auth()->user()->can('Outpatient-assesment')) {
            toast('You do not have the required authorization.', 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
        $outpatient = Outpatient::where('uuid', $uuid)->first();

        switch ($outpatient->doctorspecialization_id) {
            case 1: // General
                return view('admin.outpatient.opassessment.opassessmentgeneral.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 2: // Gynecologist
                return view('admin.outpatient.opassessment.opassessmentgynecologist.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 3: // Orthopedic
                return view('admin.outpatient.opassessment.opassessmentorthopedic.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 4: // Dermatology
                return view('admin.outpatient.opassessment.opassessmentdermatology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 5: // Urology
                return view('admin.outpatient.opassessment.opassessmenturology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 6: // Diabetology
                return view('admin.outpatient.opassessment.opassessmentdiabetology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 7: //Cardiology
                return view('admin.outpatient.opassessment.opassessmentcardiology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 8: //Paediatric
                return view('admin.outpatient.opassessment.opassessmentpaediatric.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 9: //Ophthalmology
                return view('admin.outpatient.opassessment.opassessmentophthalmology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 10: //Neurology
                return view('admin.outpatient.opassessment.opassessmentneurology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 11: //Nephrology
                return view('admin.outpatient.opassessment.opassessmentnephrology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 12: //Anesthesiology
                return view('admin.outpatient.opassessment.opassessmentanesthesiology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 13: //Sonology
                return view('admin.outpatient.opassessment.opassessmentsonology.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 14: //Gastro
                return view('admin.outpatient.opassessment.opassessmentgastro.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 15: //Dental
                return view('admin.outpatient.opassessment.opassessmentdental.index',
                    compact('outpatient', 'requesttype'));
                break;
            case 16: //General Surgeon
                return view('admin.outpatient.opassessment.opassessmentgeneralsurgeon.index',
                    compact('outpatient', 'requesttype'));
                break;
            default:
                return "Under Constrution";
        }

    }

}
