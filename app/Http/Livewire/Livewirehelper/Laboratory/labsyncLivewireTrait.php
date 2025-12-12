<?php

namespace App\Http\Livewire\Livewirehelper\Laboratory;

use App\Models\Laboratory\Laboratory\Labpatientlist;
use App\Models\Laboratory\Scan\Scanpatientlist;
use App\Models\Laboratory\Settings\Laboratorymaster\Labinvestigation\Labinvestigation;
use App\Models\Laboratory\Xray\Xraypatientlist;

trait labsyncLivewireTrait
{
    public function labinvestigationsync($labinvestigation, $user, $patientid, $objectable, $maintype, $subtype, $is_emergency)
    {

        if ($maintype == 'OP') {
            $billing_type = $objectable->patientvisit->billing_type;
        } else {
            $billing_type = $objectable->inpatient->ipadmission->billing_type;
        }
        $objectable->labinvestigation()->sync($labinvestigation);

        if ($labinvestigation && sizeof($labinvestigation)) {
            if ($objectable->labable == null) {
                $labpatient = $user->labpatientcreatable()
                    ->create(
                        [
                            'patient_id' => $patientid,
                            'doctor_id' => $objectable->doctor_id,
                            'maintype' => $maintype,
                            'subtype' => $subtype,
                            'is_emergency' => ($is_emergency && $is_emergency != null) ? $is_emergency : false,
                            'total' => $billing_type == 1 ? Labinvestigation::whereIn('id', $labinvestigation)->sum('selffee') : Labinvestigation::whereIn('id', $labinvestigation)->sum('insurancefee'),
                            'discount_percentage' => 0,
                            'discount_value' => 0,
                            'grand_total' => $billing_type == 1 ? Labinvestigation::whereIn('id', $labinvestigation)->sum('selffee') : Labinvestigation::whereIn('id', $labinvestigation)->sum('insurancefee'),
                        ]
                    );

                $labpatient->labable()
                    ->associate($objectable)
                    ->save();

            } else {
                $labpatient = $objectable->labable;
                if ($is_emergency != $labpatient->is_emergency) {
                    $labpatient->update(['is_emergency' => $is_emergency]);
                }
            }

            $labpatient->labpatientlist()->delete();

            foreach ($labinvestigation as $value) {
                $labinvestigationdata = Labinvestigation::find($value);

                $user->labpatientlistcreatable()
                    ->create(
                        [
                            'labinvestigation_id' => $labinvestigationdata->id,
                            'labinvestigation_name' => $labinvestigationdata->name,
                            'labinvestigationgroup_name' => $labinvestigationdata->labinvestigationgroup->name,
                            'units' => $labinvestigationdata->labunit?->name,
                            'range' => $labinvestigationdata->range,
                            'testmethod' => $labinvestigationdata->labtestmethod?->name,
                            'fee' => $billing_type == 1 ? $labinvestigationdata->selffee : $labinvestigationdata->insurancefee,
                            'selffee' => $labinvestigationdata->selffee,
                            'insurancefee' => $labinvestigationdata->insurancefee,
                            'labpatient_id' => $labpatient->id,
                        ]);

            }
        } else {
            $labpatient = $objectable->labable;
            ($labpatient && isset($labpatient)) ? $labpatient->labpatientlist()->delete() : '';
            ($labpatient && isset($labpatient)) ? $labpatient->delete() : '';
        }

    }

    public function scaninvestigationsync($scaninvestigation, $user, $patientid, $objectable, $maintype, $subtype, $is_emergency)
    {
        if ($maintype == 'OP') {
            $billing_type = $objectable->patientvisit->billing_type;
        } else {
            $billing_type = $objectable->inpatient->ipadmission->billing_type;
        }
        $objectable->scaninvestigation()->sync($scaninvestigation);
        if ($scaninvestigation && sizeof($scaninvestigation)) {

            if ($objectable->scanable == null) {
                $scanpatient = $user->scanpatientcreatable()
                    ->create(
                        [
                            'patient_id' => $patientid,
                            'doctor_id' => $objectable->doctor_id,
                            'maintype' => $maintype,
                            'subtype' => $subtype,
                            'is_emergency' => ($is_emergency && $is_emergency != null) ? $is_emergency : false,
                            'total' => $billing_type == 1 ? Labinvestigation::whereIn('id', $scaninvestigation)->sum('selffee') : Labinvestigation::whereIn('id', $scaninvestigation)->sum('insurancefee'),
                            'discount_percentage' => 0,
                            'discount_value' => 0,
                            'grand_total' => $billing_type == 1 ? Labinvestigation::whereIn('id', $scaninvestigation)->sum('selffee') : Labinvestigation::whereIn('id', $scaninvestigation)->sum('insurancefee'),

                        ]
                    );

                $scanpatient->scanable()
                    ->associate($objectable)
                    ->save();

            } else {
                $scanpatient = $objectable->scanable;
                if ($is_emergency != $scanpatient->is_emergency) {
                    $scanpatient->update(['is_emergency' => $is_emergency]);
                }
            }

            $scanpatient->scanpatientlist()->delete();

            foreach ($scaninvestigation as $value) {
                $scaninvestigationdata = Labinvestigation::find($value);
                $user->scanpatientlistcreatable()->create(
                    [
                        'labinvestigation_id' => $scaninvestigationdata->id,
                        'scaninvestigation_name' => $scaninvestigationdata->name,
                        'scaninvestigationgroup_name' => $scaninvestigationdata->labinvestigationgroup->name,
                        'units' => $scaninvestigationdata->labunit?->name,
                        'range' => $scaninvestigationdata->range,
                        'testmethod' => $scaninvestigationdata->labtestmethod?->name,
                        'fee' => $billing_type == 1 ? $scaninvestigationdata->selffee : $scaninvestigationdata->insurancefee,
                        'selffee' => $scaninvestigationdata->selffee,
                        'insurancefee' => $scaninvestigationdata->insurancefee,
                        'scanpatient_id' => $scanpatient->id,
                    ]);
            }
        } else {
            $scanpatient = $objectable->scanable;
            ($scanpatient && isset($scanpatient)) ? $scanpatient->scanpatientlist()->delete() : '';
            ($scanpatient && isset($scanpatient)) ? $scanpatient->delete() : '';
        }
    }

    public function xrayinvestigationsync($xrayinvestigation, $user, $patientid, $objectable, $maintype, $subtype, $is_emergency)
    {
        if ($maintype == 'OP') {
            $billing_type = $objectable->patientvisit->billing_type;
        } else {
            $billing_type = $objectable->inpatient->ipadmission->billing_type;
        }
        $objectable->xrayinvestigation()->sync($xrayinvestigation);
        if ($xrayinvestigation && sizeof($xrayinvestigation)) {

            if ($objectable->xrayable == null) {
                $xraypatient = $user->xraypatientcreatable()
                    ->create(
                        [
                            'patient_id' => $patientid,
                            'doctor_id' => $objectable->doctor_id,
                            'maintype' => $maintype,
                            'subtype' => $subtype,
                            'is_emergency' => ($is_emergency && $is_emergency != null) ? $is_emergency : false,
                            'total' => $billing_type == 1 ? Labinvestigation::whereIn('id', $xrayinvestigation)->sum('selffee') : Labinvestigation::whereIn('id', $xrayinvestigation)->sum('insurancefee'),
                            'discount_percentage' => 0,
                            'discount_value' => 0,
                            'grand_total' => $billing_type == 1 ? Labinvestigation::whereIn('id', $xrayinvestigation)->sum('selffee') : Labinvestigation::whereIn('id', $xrayinvestigation)->sum('insurancefee'),
                        ]
                    );
                $xraypatient->xrayable()
                    ->associate($objectable)
                    ->save();

            } else {
                $xraypatient = $objectable->xrayable;
                if ($is_emergency != $xraypatient->is_emergency) {
                    $xraypatient->update(['is_emergency' => $is_emergency]);
                }
            }

            $xraypatient->xraypatientlist()->delete();

            foreach ($xrayinvestigation as $value) {
                $xrayinvestigationdata = Labinvestigation::find($value);
                $user->xraypatientlistcreatable()->create(
                    [
                        'labinvestigation_id' => $xrayinvestigationdata->id,
                        'xrayinvestigation_name' => $xrayinvestigationdata->name,
                        'xrayinvestigationgroup_name' => $xrayinvestigationdata->labinvestigationgroup->name,
                        'units' => $xrayinvestigationdata->labunit?->name,
                        'range' => $xrayinvestigationdata->range,
                        'testmethod' => $xrayinvestigationdata->labtestmethod?->name,
                        'fee' => $billing_type == 1 ? $xrayinvestigationdata->selffee : $xrayinvestigationdata->insurancefee,
                        'selffee' => $xrayinvestigationdata->selffee,
                        'insurancefee' => $xrayinvestigationdata->insurancefee,
                        'xraypatient_id' => $xraypatient->id,
                    ]);
            }
        } else {
            $xraypatient = $objectable->xrayable;
            ($xraypatient && isset($xraypatient)) ? $xraypatient->xraypatientlist()->delete() : '';
            ($xraypatient && isset($xraypatient)) ? $xraypatient->delete() : '';
        }
    }
}
