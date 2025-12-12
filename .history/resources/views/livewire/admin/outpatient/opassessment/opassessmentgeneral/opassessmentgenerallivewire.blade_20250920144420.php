<div>

    @include('livewire.admin.outpatient.opassessment.common.oppatientregistrationdetails')

    @include('livewire.admin.outpatient.opassessment.common.oppatientvisitdetails')

    @include('livewire.admin.outpatient.opassessment.opassessmentgeneral.opassessmentgeneralform')

    @include('livewire.admin.outpatient.opassessment.common.confirmmovetoip')
</div>

<div>
    <livewire:admin.outpatient.opassessment.common.oppatientlabinvestigation />
    <livewire:admin.outpatient.opassessment.common.oppatientscaninvestigation />
    <livewire:admin.outpatient.opassessment.common.oppatientxrayinvestigation />
    <livewire:admin.outpatient.opassessment.common.oppateintprescription />
</div>