<?php

namespace App\Models\Commontraits\CommontrackingTraits;

use App\Models\Admin\Account\Patient\Patientstatement;
use App\Models\Admin\Billing\Billdiscount\Billdiscount;
use App\Models\Admin\Billing\Ipbilling\Ipbilling;
use App\Models\Admin\Billing\Ipbilling\Ipbillingservicelist;
use App\Models\Admin\Billing\Opbilling\Opbilling;
use App\Models\Admin\Billing\Opbilling\Opbillinglist;
use App\Models\Admin\Billing\Opbilling\Opbillingservicelist;
use App\Models\Admin\Billing\Otbilling\Otbilling;
use App\Models\Admin\Billing\Otbilling\Otbillingservicelist;
use App\Models\Admin\Billing\Receipt\Receipt;
use App\Models\Admin\Emr\Emr;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ipadmission;
use App\Models\Admin\Inpatient\Ipforeigner;
use App\Models\Admin\Inpatient\Ipnursingstation;
use App\Models\Admin\Insurance\Patientinsurance;
use App\Models\Admin\Outpatient\Outpatient;
use App\Models\Admin\Patient\Patientvisit;
use App\Models\Admin\Prescription\Prescription;
use App\Models\Admin\Prescription\Prescriptionlist;
use App\Models\Patient\Auth\Patient;

trait PatienttrackingTraits
{
    // Patient
    public function patientcreatable()
    {
        return $this->morphMany(Patient::class, 'creatable');
    }

    public function patientupdatable()
    {
        return $this->morphMany(Patient::class, 'updatable');
    }

    // Patient Visit
    public function patientvisitcreatable()
    {
        return $this->morphMany(Patientvisit::class, 'creatable');
    }

    public function patientvisitupdatable()
    {
        return $this->morphMany(Patientvisit::class, 'updatable');
    }

    // Ip Billing
    public function ipbillingcreatable()
    {
        return $this->morphMany(Ipbilling::class, 'creatable');
    }

    public function ipbillingupdatable()
    {
        return $this->morphMany(Ipbilling::class, 'updatable');
    }

    // Ip Billing Service List
    public function ipbillingservicelistcreatable()
    {
        return $this->morphMany(Ipbillingservicelist::class, 'creatable');
    }

    public function ipbillingservicelistupdatable()
    {
        return $this->morphMany(Ipbillingservicelist::class, 'updatable');
    }

    // Op Billing
    public function opbillingcreatable()
    {
        return $this->morphMany(Opbilling::class, 'creatable');
    }

    public function opbillingupdatable()
    {
        return $this->morphMany(Opbilling::class, 'updatable');
    }

    // Op Billing List
    public function opbillinglistcreatable()
    {
        return $this->morphMany(Opbillinglist::class, 'creatable');
    }

    public function opbillinglistupdatable()
    {
        return $this->morphMany(Opbillinglist::class, 'updatable');
    }

    // Op Billing Service List
    public function opbillingservicelistcreatable()
    {
        return $this->morphMany(Opbillingservicelist::class, 'creatable');
    }

    public function opbillingservicelistupdatable()
    {
        return $this->morphMany(Opbillingservicelist::class, 'updatable');
    }

    // Receipt
    public function receiptcreatable()
    {
        return $this->morphMany(Receipt::class, 'creatable');
    }

    public function receiptupdatable()
    {
        return $this->morphMany(Receipt::class, 'updatable');
    }

    // Bill discount/cancel
    public function billdiscountcreatable()
    {
        return $this->morphMany(Billdiscount::class, 'creatable');
    }

    public function billdiscountupdatable()
    {
        return $this->morphMany(Billdiscount::class, 'updatable');
    }

    // Ot Billing
    public function otbillingcreatable()
    {
        return $this->morphMany(Otbilling::class, 'creatable');
    }

    public function otbillingupdatable()
    {
        return $this->morphMany(Otbilling::class, 'updatable');
    }

    // Ot Billing Service List
    public function otbillingservicelistcreatable()
    {
        return $this->morphMany(Otbillingservicelist::class, 'creatable');
    }

    public function otbillingservicelistupdatable()
    {
        return $this->morphMany(Otbillingservicelist::class, 'updatable');
    }

    // Out Patient
    public function outpatientcreatable()
    {
        return $this->morphMany(Outpatient::class, 'creatable');
    }

    public function outpatientupdatable()
    {
        return $this->morphMany(Outpatient::class, 'updatable');
    }

    // Ip Patient
    public function inpatientcreatable()
    {
        return $this->morphMany(Inpatient::class, 'creatable');
    }

    public function inpatientupdatable()
    {
        return $this->morphMany(Inpatient::class, 'updatable');
    }

    // Ip Admission
    public function ipadmissioncreatable()
    {
        return $this->morphMany(Ipadmission::class, 'creatable');
    }

    public function ipadmissionupdatable()
    {
        return $this->morphMany(Ipadmission::class, 'updatable');
    }

    // Patient insurance
    public function patientinsurancecreatable()
    {
        return $this->morphMany(Patientinsurance::class, 'creatable');
    }

    public function patientinsuranceupdatable()
    {
        return $this->morphMany(Patientinsurance::class, 'updatable');
    }

    // Ip Nursing Station
    public function ipnursingstationcreatable()
    {
        return $this->morphMany(Ipnursingstation::class, 'creatable');
    }

    public function ipnursingstationupdatable()
    {
        return $this->morphMany(Ipnursingstation::class, 'updatable');
    }

    // Ip Foreigner
    public function ipforeignercreatable()
    {
        return $this->morphMany(Ipforeigner::class, 'creatable');
    }

    public function ipforeignerupdatable()
    {
        return $this->morphMany(Ipforeigner::class, 'updatable');
    }

    // Patient Statement
    public function patientstatementcreatable()
    {
        return $this->morphMany(Patientstatement::class, 'creatable');
    }

    public function patientstatementupdatable()
    {
        return $this->morphMany(Patientstatement::class, 'updatable');
    }

    // Prescription
    public function prescriptioncreatable()
    {
        return $this->morphMany(Prescription::class, 'creatable');
    }

    public function prescriptionupdatable()
    {
        return $this->morphMany(Prescription::class, 'updatable');
    }

    // Prescriptionlist
    public function prescriptionlistcreatable()
    {
        return $this->morphMany(Prescriptionlist::class, 'creatable');
    }

    public function prescriptionlistupdatable()
    {
        return $this->morphMany(Prescriptionlist::class, 'updatable');
    }

    // Emr
    public function emrcreatable()
    {
        return $this->morphMany(Emr::class, 'creatable');
    }

    public function emrupdatable()
    {
        return $this->morphMany(Emr::class, 'updatable');
    }

}
