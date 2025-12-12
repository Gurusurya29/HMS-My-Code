<div class="row text-dark p-2 shadow-sm border border-2 border-primary rounded">
    {{-- theme_bg_color --}}
    @include('helper.formhelper.showlabel', [
        'name' => 'UHID',
        'value' => $patientinsurance->patient->uhid,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'NAME',
        'value' => $patientinsurance->patient->salutation
            ? config('archive.salutation')[$patientinsurance->patient->salutation] .
                '. ' .
                $patientinsurance->patient->name
            : $patientinsurance->patient->name,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'MOBILE NUMBER',
        'value' => $patientinsurance->patient->phone,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'GENDER',
        'value' => $patientinsurance->patient->gender
            ? config('archive.gender')[$patientinsurance->patient->gender]
            : '-',
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'AGE',
        'value' => $patientinsurance->patient->age ?? '-',
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'BLOOD GROUP',
        'value' => $patientinsurance->patient->blood_group
            ? config('archive.blood_group')[$patientinsurance->patient->blood_group]
            : '',
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'AADHAR NUMBER',
        'value' => $patientinsurance->patient->aadharid,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'DATE OF BIRTH',
        'value' => $patientinsurance->patient->dob
            ? date('d-m-Y', strtotime($patientinsurance->patient->dob))
            : '',
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'FATHER/HUSBAND',
        'value' => $patientinsurance->patient->fatherorhusband,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'MARITAL STATUS',
        'value' => $patientinsurance->patient->marital_status
            ? config('archive.marital_status')[$patientinsurance->patient->marital_status]
            : '',
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'SPOUSE NAME',
        'value' => $patientinsurance->patient->spouse_name,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'CONTACT PERSON NAME',
        'value' => $patientinsurance->patient->contact_person_name,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'CONTACT PERSON PHONE',
        'value' => $patientinsurance->patient->contact_person_phone,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'DOOR NUMBER',
        'value' => $patientinsurance->patient->door_no,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'AREA',
        'value' => $patientinsurance->patient->area,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'CITY',
        'value' => $patientinsurance->patient->city,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'PINCODE',
        'value' => $patientinsurance->patient->pincode,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'STATE',
        'value' => $patientinsurance->patient->state?->name,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
    @include('helper.formhelper.showlabel', [
        'name' => 'COUNTRY',
        'value' => $patientinsurance->patient->country?->name,
        'columnone' => 'col-md-6',
        'columntwo' => 'col-5',
        'columnthree' => 'col-7',
    ])
</div>
