<?php

namespace App\Models\Commontraits\CommontrackingTraits;

use App\Models\Admin\Account\Employee\Employeestatement;
use App\Models\Admin\Account\Hospital\Hospitalstatement;
use App\Models\Admin\Account\Paymentvoucher\Paymentvoucher;
use App\Models\Admin\Account\Supplier\Supplierstatement;
use App\Models\Admin\Auth\User;
use App\Models\Admin\Dischargesummary\Dsanesthesiology\Dsanesthesiology;
use App\Models\Admin\Dischargesummary\Dscardiology\Dscardiology;
use App\Models\Admin\Dischargesummary\Dsdental\Dsdental;
use App\Models\Admin\Dischargesummary\Dsdermatology\Dsdermatology;
use App\Models\Admin\Dischargesummary\Dsdiabetology\Dsdiabetology;
use App\Models\Admin\Dischargesummary\Dsgastro\Dsgastro;
use App\Models\Admin\Dischargesummary\Dsgeneralsurgeon\Dsgeneralsurgeon;
use App\Models\Admin\Dischargesummary\Dsgeneral\Dsgeneral;
use App\Models\Admin\Dischargesummary\Dsgynecology\Dsgynecology;
use App\Models\Admin\Dischargesummary\Dsgynecology\Dsgynecologybaby;
use App\Models\Admin\Dischargesummary\Dsnephrology\Dsnephrology;
use App\Models\Admin\Dischargesummary\Dsneurology\Dsneurology;
use App\Models\Admin\Dischargesummary\Dsophthalmology\Dsophthalmology;
use App\Models\Admin\Dischargesummary\Dsorthopedic\Dsorthopedic;
use App\Models\Admin\Dischargesummary\Dspaediatric\Dspaediatric;
use App\Models\Admin\Dischargesummary\Dssonology\Dssonology;
use App\Models\Admin\Dischargesummary\Dsurology\Dsurology;
use App\Models\Admin\Employee\Employee;
use App\Models\Admin\Facility\Facility;
use App\Models\Admin\Inpatient\Ipassesment;
use App\Models\Admin\Inpatient\Ippatienttransfer;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Admin\Operationtheatre\Otsurgerynote\Otsurgerypostop;
use App\Models\Admin\Operationtheatre\Otsurgerynote\Otsurgerypreop;
use App\Models\Admin\Outpatient\Anesthesiology\Opanesthesiology;
use App\Models\Admin\Outpatient\Cardiology\Opcardiology;
use App\Models\Admin\Outpatient\Dental\Opdental;
use App\Models\Admin\Outpatient\Dermatology\Opdermatology;
use App\Models\Admin\Outpatient\Diabetology\Opdiabetology;
use App\Models\Admin\Outpatient\Gastro\Opgastro;
use App\Models\Admin\Outpatient\Generalsurgeon\Opgeneralsurgeon;
use App\Models\Admin\Outpatient\General\Opgeneral;
use App\Models\Admin\Outpatient\Gynecology\Opgynecology;
use App\Models\Admin\Outpatient\Nephrology\Opnephrology;
use App\Models\Admin\Outpatient\Neurology\Opneurology;
use App\Models\Admin\Outpatient\Ophthalmology\Opophthalmology;
use App\Models\Admin\Outpatient\Ortho\Oporthopedic;
use App\Models\Admin\Outpatient\Paediatric\Oppaediatric;
use App\Models\Admin\Outpatient\Sonology\Opsonology;
use App\Models\Admin\Outpatient\Urology\Opurology;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Admin\Settings\Doctorsetting\Doctorconsultationfee;
use App\Models\Admin\Settings\Doctorsetting\Doctorspecialization;
use App\Models\Admin\Settings\Documentsetting\Medicaldocument;
use App\Models\Admin\Settings\Generalsettings\Emailsetting;
use App\Models\Admin\Settings\Generalsettings\Fcmsetting;
use App\Models\Admin\Settings\Generalsettings\Gatewaysetting;
use App\Models\Admin\Settings\Generalsettings\Smssetting;
use App\Models\Admin\Settings\Generalsettings\Themesetting;
use App\Models\Admin\Settings\Ipsetting\Ipservicecategory;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use App\Models\Admin\Settings\Ipsetting\Iptreatment;
use App\Models\Admin\Settings\Opsetting\Diagnosismaster;
use App\Models\Admin\Settings\Opsetting\Opservicemaster;
use App\Models\Admin\Settings\Opsetting\Physicalexam;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\Reference;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Admin\Settings\Patientvisitsetting\Allergymaster;
use App\Models\Admin\Settings\Patientvisitsetting\Currentcomplaints;
use App\Models\Admin\Settings\Patientvisitsetting\Insurancecompany;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardfloor;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Admin\Wardmanagement\Bedorroom\Blockbedorroomhistory;
use App\Models\Admin\Wardmanagement\Housekeeping\Housekeepinghistory;

trait AdmintrackingTraits
{
    public function admincreatable()
    {
        return $this->morphMany(User::class, 'creatable');
    }

    public function adminupdatable()
    {
        return $this->morphMany(User::class, 'updatable');
    }

    // Doctor Consultation Fee
    public function doctorconsultationfeecreatable()
    {
        return $this->morphMany(Doctorconsultationfee::class, 'creatable');
    }

    public function doctorconsultationfeeupdatable()
    {
        return $this->morphMany(Doctorconsultationfee::class, 'updatable');
    }

    // Doctor Specialization
    public function doctorspecializationcreatable()
    {
        return $this->morphMany(Doctorspecialization::class, 'creatable');
    }

    public function doctorspecializationupdatable()
    {
        return $this->morphMany(Doctorspecialization::class, 'updatable');
    }

    // Ward type
    public function wardtypecreatable()
    {
        return $this->morphMany(Wardtype::class, 'creatable');
    }

    public function wardtypeupdatable()
    {
        return $this->morphMany(Wardtype::class, 'updatable');
    }

    // Ward floor
    public function wardfloorcreatable()
    {
        return $this->morphMany(Wardfloor::class, 'creatable');
    }

    public function wardfloorupdatable()
    {
        return $this->morphMany(Wardfloor::class, 'updatable');
    }

    // Ward room number
    public function bedorroomnumbercreatable()
    {
        return $this->morphMany(Bedorroomnumber::class, 'creatable');
    }

    public function bedorroomnumberupdatable()
    {
        return $this->morphMany(Bedorroomnumber::class, 'updatable');
    }

    // Email Settings
    public function emailsettingcreatable()
    {
        return $this->morphMany(Emailsetting::class, 'creatable');
    }

    public function emailsettingupdatable()
    {
        return $this->morphMany(Emailsetting::class, 'updatable');
    }

    // FCM Settings
    public function fcmsettingcreatable()
    {
        return $this->morphMany(Fcmsetting::class, 'creatable');
    }

    public function fcmsettingupdatable()
    {
        return $this->morphMany(Fcmsetting::class, 'updatable');
    }

    // Gateway Settings
    public function gatewaysettingcreatable()
    {
        return $this->morphMany(Gatewaysetting::class, 'creatable');
    }

    public function gatewaysettingupdatable()
    {
        return $this->morphMany(Gatewaysetting::class, 'updatable');
    }

    // Sms Settings
    public function smssettingcreatable()
    {
        return $this->morphMany(Smssetting::class, 'creatable');
    }

    public function smssettingupdatable()
    {
        return $this->morphMany(Smssetting::class, 'updatable');
    }

    // Theme Settings
    public function themesettingcreatable()
    {
        return $this->morphMany(Themesetting::class, 'creatable');
    }

    public function themesettingupdatable()
    {
        return $this->morphMany(Themesetting::class, 'updatable');
    }

    // Insurance Company
    public function insurancecompanycreatable()
    {
        return $this->morphMany(Insurancecompany::class, 'creatable');
    }

    public function insurancecompanyupdatable()
    {
        return $this->morphMany(Insurancecompany::class, 'updatable');
    }

    // Diagnosis Master
    public function diagnosismastercreatable()
    {
        return $this->morphMany(Diagnosismaster::class, 'creatable');
    }

    public function diagnosismasterupdatable()
    {
        return $this->morphMany(Diagnosismaster::class, 'updatable');
    }

    // Physicalandgeneralexam Master
    public function physicalexamcreatable()
    {
        return $this->morphMany(Physicalexam::class, 'creatable');
    }

    public function physicalexamupdatable()
    {
        return $this->morphMany(Physicalexam::class, 'updatable');
    }

    // Allergy Master
    public function allergymastercreatable()
    {
        return $this->morphMany(Allergymaster::class, 'creatable');
    }

    public function allergymasterupdatable()
    {
        return $this->morphMany(Allergymaster::class, 'updatable');
    }

    // Country Master
    public function countrycreatable()
    {
        return $this->morphMany(Country::class, 'creatable');
    }

    public function countryupdatable()
    {
        return $this->morphMany(Country::class, 'updatable');
    }

    // State Master
    public function statecreatable()
    {
        return $this->morphMany(State::class, 'creatable');
    }

    public function stateupdatable()
    {
        return $this->morphMany(State::class, 'updatable');
    }

    // OP Service
    public function opservicemastercreatable()
    {
        return $this->morphMany(Opservicemaster::class, 'creatable');
    }

    public function opservicemasterupdatable()
    {
        return $this->morphMany(Opservicemaster::class, 'updatable');
    }

    // IP Treatment
    public function iptreatmentcreatable()
    {
        return $this->morphMany(Iptreatment::class, 'creatable');
    }

    public function iptreatmentupdatable()
    {
        return $this->morphMany(Iptreatment::class, 'updatable');
    }

    // IP Service Category
    public function ipservicecategorycreatable()
    {
        return $this->morphMany(Ipservicecategory::class, 'creatable');
    }

    public function ipservicecategoryupdatable()
    {
        return $this->morphMany(Ipservicecategory::class, 'updatable');
    }

// IP Service
    public function ipservicemastercreatable()
    {
        return $this->morphMany(Ipservicemaster::class, 'creatable');
    }

    public function ipservicemasterupdatable()
    {
        return $this->morphMany(Ipservicemaster::class, 'updatable');
    }

    // Medical Document
    public function medicaldocumentcreatable()
    {
        return $this->morphMany(Medicaldocument::class, 'creatable');
    }

    public function medicaldocumentupdatable()
    {
        return $this->morphMany(Medicaldocument::class, 'updatable');
    }

    // Current Complaint Master
    public function currentcomplaintscreatable()
    {
        return $this->morphMany(Currentcomplaints::class, 'creatable');
    }

    public function currentcomplaintsupdatable()
    {
        return $this->morphMany(Currentcomplaints::class, 'updatable');
    }

    // Reference Master
    public function referencecreatable()
    {
        return $this->morphMany(Reference::class, 'creatable');
    }

    public function referenceupdatable()
    {
        return $this->morphMany(Reference::class, 'updatable');
    }

    //supplier
    public function suppliercreatable()
    {
        return $this->morphMany(Supplier::class, 'creatable');
    }

    public function supplierupdatable()
    {
        return $this->morphMany(Supplier::class, 'updatable');
    }

    // OP General
    public function opgeneralcreatable()
    {
        return $this->morphMany(Opgeneral::class, 'creatable');
    }

    public function opgeneralupdatable()
    {
        return $this->morphMany(Opgeneral::class, 'updatable');
    }

    // OP Gynecology
    public function opgynecologycreatable()
    {
        return $this->morphMany(Opgynecology::class, 'creatable');
    }

    public function opgynecologyupdatable()
    {
        return $this->morphMany(Opgynecology::class, 'updatable');
    }

    // OP Orthopedic
    public function oporthopediccreatable()
    {
        return $this->morphMany(Oporthopedic::class, 'creatable');
    }

    public function oporthopedicupdatable()
    {
        return $this->morphMany(Oporthopedic::class, 'updatable');
    }

    // OP Dermatology
    public function opdermatologycreatable()
    {
        return $this->morphMany(Opdermatology::class, 'creatable');
    }

    public function opdermatologyupdatable()
    {
        return $this->morphMany(Opdermatology::class, 'updatable');
    }

    // OP Urology
    public function opurologycreatable()
    {
        return $this->morphMany(Opurology::class, 'creatable');
    }

    public function opurologyupdatable()
    {
        return $this->morphMany(Opurology::class, 'updatable');
    }

    // OP Diabetology
    public function opdiabetologycreatable()
    {
        return $this->morphMany(Opdiabetology::class, 'creatable');
    }

    public function opdiabetologyupdatable()
    {
        return $this->morphMany(Opdiabetology::class, 'updatable');
    }

    // OP Cardiology
    public function opcardiologycreatable()
    {
        return $this->morphMany(Opcardiology::class, 'creatable');
    }

    public function opcardiologyupdatable()
    {
        return $this->morphMany(Opcardiology::class, 'updatable');
    }

    // OP paediatric
    public function oppaediatriccreatable()
    {
        return $this->morphMany(Oppaediatric::class, 'creatable');
    }

    public function oppaediatricupdatable()
    {
        return $this->morphMany(Oppaediatric::class, 'updatable');
    }

    // OP ophthalmology
    public function opophthalmologycreatable()
    {
        return $this->morphMany(Opophthalmology::class, 'creatable');
    }

    public function opophthalmologyupdatable()
    {
        return $this->morphMany(Opophthalmology::class, 'updatable');
    }

    // OP neurology
    public function opneurologycreatable()
    {
        return $this->morphMany(Opneurology::class, 'creatable');
    }

    public function opneurologyupdatable()
    {
        return $this->morphMany(Opneurology::class, 'updatable');
    }

    // OP nephrology
    public function opnephrologycreatable()
    {
        return $this->morphMany(Opnephrology::class, 'creatable');
    }

    public function opnephrologyupdatable()
    {
        return $this->morphMany(Opnephrology::class, 'updatable');
    }

    // OP anesthesiology
    public function opanesthesiologycreatable()
    {
        return $this->morphMany(Opanesthesiology::class, 'creatable');
    }

    public function opanesthesiologyupdatable()
    {
        return $this->morphMany(Opanesthesiology::class, 'updatable');
    }

    // OP sonology
    public function opsonologycreatable()
    {
        return $this->morphMany(Opsonology::class, 'creatable');
    }

    public function opsonologyupdatable()
    {
        return $this->morphMany(Opsonology::class, 'updatable');
    }

    // OP gastro
    public function opgastrocreatable()
    {
        return $this->morphMany(Opgastro::class, 'creatable');
    }

    public function opgastroupdatable()
    {
        return $this->morphMany(Opgastro::class, 'updatable');
    }

    // OP dental
    public function opdentalcreatable()
    {
        return $this->morphMany(Opdental::class, 'creatable');
    }

    public function opdentalupdatable()
    {
        return $this->morphMany(Opdental::class, 'updatable');
    }

    // OP Generalsurgeon
    public function opgeneralsurgeoncreatable()
    {
        return $this->morphMany(Opgeneralsurgeon::class, 'creatable');
    }

    public function opgeneralsurgeonupdatable()
    {
        return $this->morphMany(Opgeneralsurgeon::class, 'updatable');
    }

    // Doctor
    public function adddoctorcreatable()
    {
        return $this->morphMany(Doctor::class, 'creatable');
    }

    public function adddoctorupdatable()
    {
        return $this->morphMany(Doctor::class, 'updatable');
    }

    // Block bed or room History
    public function blockbedorroomhistorycreatable()
    {
        return $this->morphMany(Blockbedorroomhistory::class, 'creatable');
    }

    public function blockbedorroomhistoryupdatable()
    {
        return $this->morphMany(Blockbedorroomhistory::class, 'updatable');
    }

// House keeping history
    public function housekeepinghistorycreatable()
    {
        return $this->morphMany(Housekeepinghistory::class, 'creatable');
    }

    public function housekeepinghistoryupdatable()
    {
        return $this->morphMany(Housekeepinghistory::class, 'updatable');
    }

    // Ip assesment
    public function ipassesmentcreatable()
    {
        return $this->morphMany(Ipassesment::class, 'creatable');
    }

    public function ipassesmentupdatable()
    {
        return $this->morphMany(Ipassesment::class, 'updatable');
    }

    // Discharge summary general
    public function dsgeneralcreatable()
    {
        return $this->morphMany(Dsgeneral::class, 'creatable');
    }

    public function dsgeneralupdatable()
    {
        return $this->morphMany(Dsgeneral::class, 'updatable');
    }

    // Discharge summary gynecology
    public function dsgynecologycreatable()
    {
        return $this->morphMany(Dsgynecology::class, 'creatable');
    }

    public function dsgynecologyupdatable()
    {
        return $this->morphMany(Dsgynecology::class, 'updatable');
    }

    // Discharge summary gynecologybaby
    public function dsgynecologybabycreatable()
    {
        return $this->morphMany(Dsgynecologybaby::class, 'creatable');
    }

    public function dsgynecologybabyupdatable()
    {
        return $this->morphMany(Dsgynecologybaby::class, 'updatable');
    }

    // Discharge summary orthopedic
    public function dsorthopediccreatable()
    {
        return $this->morphMany(Dsorthopedic::class, 'creatable');
    }

    public function dsorthopedicupdatable()
    {
        return $this->morphMany(Dsorthopedic::class, 'updatable');
    }

    // Discharge summary dermatology
    public function dsdermatologycreatable()
    {
        return $this->morphMany(Dsdermatology::class, 'creatable');
    }

    public function dsdermatologyupdatable()
    {
        return $this->morphMany(Dsdermatology::class, 'updatable');
    }

    // Discharge summary urology
    public function dsurologycreatable()
    {
        return $this->morphMany(Dsurology::class, 'creatable');
    }

    public function dsurologyupdatable()
    {
        return $this->morphMany(Dsurology::class, 'updatable');
    }

    // Discharge summary diabetology
    public function dsdiabetologycreatable()
    {
        return $this->morphMany(Dsdiabetology::class, 'creatable');
    }

    public function dsdiabetologyupdatable()
    {
        return $this->morphMany(Dsdiabetology::class, 'updatable');
    }

    // Discharge summary cardiology
    public function dscardiologycreatable()
    {
        return $this->morphMany(Dscardiology::class, 'creatable');
    }

    public function dscardiologyupdatable()
    {
        return $this->morphMany(Dscardiology::class, 'updatable');
    }

    // Discharge summary paediatric
    public function dspaediatriccreatable()
    {
        return $this->morphMany(Dspaediatric::class, 'creatable');
    }

    public function dspaediatricupdatable()
    {
        return $this->morphMany(Dspaediatric::class, 'updatable');
    }

    // Discharge summary ophthalmology
    public function dsophthalmologycreatable()
    {
        return $this->morphMany(Dsophthalmology::class, 'creatable');
    }

    public function dsophthalmologyupdatable()
    {
        return $this->morphMany(Dsophthalmology::class, 'updatable');
    }

    // Discharge summary neurology
    public function dsneurologycreatable()
    {
        return $this->morphMany(Dsneurology::class, 'creatable');
    }

    public function dsneurologyupdatable()
    {
        return $this->morphMany(Dsneurology::class, 'updatable');
    }

    // Discharge summary nephrology
    public function dsnephrologycreatable()
    {
        return $this->morphMany(Dsnephrology::class, 'creatable');
    }

    public function dsnephrologyupdatable()
    {
        return $this->morphMany(Dsnephrology::class, 'updatable');
    }

    // Discharge summary anesthesiology
    public function dsanesthesiologycreatable()
    {
        return $this->morphMany(Dsanesthesiology::class, 'creatable');
    }

    public function dsanesthesiologyupdatable()
    {
        return $this->morphMany(Dsanesthesiology::class, 'updatable');
    }

    // Discharge summary sonology
    public function dssonologycreatable()
    {
        return $this->morphMany(Dssonology::class, 'creatable');
    }

    public function dssonologyupdatable()
    {
        return $this->morphMany(Dssonology::class, 'updatable');
    }

    // Discharge summary gastro
    public function dsgastrocreatable()
    {
        return $this->morphMany(Dsgastro::class, 'creatable');
    }

    public function dsgastroupdatable()
    {
        return $this->morphMany(Dsgastro::class, 'updatable');
    }

    // Discharge summary dental
    public function dsdentalcreatable()
    {
        return $this->morphMany(Dsdental::class, 'creatable');
    }

    public function dsdentalupdatable()
    {
        return $this->morphMany(Dsdental::class, 'updatable');
    }

    // Discharge summary generalsurgeon
    public function dsgeneralsurgeoncreatable()
    {
        return $this->morphMany(Dsgeneralsurgeon::class, 'creatable');
    }

    public function dsgeneralsurgeonupdatable()
    {
        return $this->morphMany(Dsgeneralsurgeon::class, 'updatable');
    }

    // IP Patient transfer
    public function ippatienttransfercreatable()
    {
        return $this->morphMany(Ippatienttransfer::class, 'creatable');
    }

    public function ippatienttransferupdatable()
    {
        return $this->morphMany(Ippatienttransfer::class, 'updatable');
    }

    // OT Schedule
    public function otschedulecreatable()
    {
        return $this->morphMany(Otschedule::class, 'creatable');
    }

    public function otscheduleupdatable()
    {
        return $this->morphMany(Otschedule::class, 'updatable');
    }

    // OT Surgery Pre-op
    public function otsurgerypreopcreatable()
    {
        return $this->morphMany(Otsurgerypreop::class, 'creatable');
    }

    public function otsurgerypreopupdatable()
    {
        return $this->morphMany(Otsurgerypreop::class, 'updatable');
    }

    // OT Surgery POst-op
    public function otsurgerypostopcreatable()
    {
        return $this->morphMany(Otsurgerypostop::class, 'creatable');
    }

    public function otsurgerypostopupdatable()
    {
        return $this->morphMany(Otsurgerypostop::class, 'updatable');
    }

    // Facility
    public function facilitycreatable()
    {
        return $this->morphMany(Facility::class, 'creatable');
    }

    public function facilityupdatable()
    {
        return $this->morphMany(Facility::class, 'updatable');
    }

    public function employeecreatable()
    {
        return $this->morphMany(Employee::class, 'creatable');
    }

    public function employeeupdatable()
    {
        return $this->morphMany(Employee::class, 'updatable');
    }

    // Paymentvoucher
    public function paymentvouchercreatable()
    {
        return $this->morphMany(Paymentvoucher::class, 'creatable');
    }

    public function paymentvoucherupdatable()
    {
        return $this->morphMany(Paymentvoucher::class, 'updatable');
    }

    // hospital Statement
    public function hospitalstatementcreatable()
    {
        return $this->morphMany(Hospitalstatement::class, 'creatable');
    }

    public function hospitalstatementupdatable()
    {
        return $this->morphMany(Hospitalstatement::class, 'updatable');
    }

    // employee Statement
    public function employeestatementcreatable()
    {
        return $this->morphMany(Employeestatement::class, 'creatable');
    }

    public function employeestatementupdatable()
    {
        return $this->morphMany(Employeestatement::class, 'updatable');
    }

    // supplier Statement
    public function supplierstatementcreatable()
    {
        return $this->morphMany(Supplierstatement::class, 'creatable');
    }

    public function supplierstatementupdatable()
    {
        return $this->morphMany(Supplierstatement::class, 'updatable');
    }

}
