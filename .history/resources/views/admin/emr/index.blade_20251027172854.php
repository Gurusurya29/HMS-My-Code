@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
<x-admin.layouts.adminnavbar modulename="EMR" />
@endsection

@section('main-content')
@can('Emr')
<div class="card col-sm-12 mx-auto">
    <div class="card-header text-white theme_bg_color h5">EMR</div>
    <div class="card-body bg-light p-0">
        @livewire('admin.emr.emrlivewire')
    </div>
</div>
@endcan
@endsection
@section('footerSection')
@include('helper.sidenavhelper.sidenavactive', [
'type' => 1,
'nameone' => '#emr_sidenav',
])

<script>
document.addEventListener('livewire:initialized', () => {

    // 🟢 Show Modal
    Livewire.on('showmodal', () => {
        const modalEl = document.getElementById('showModal');
        if (!modalEl) {
            console.error('Modal element #showModal not found.');
            return;
        }

        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    });

    // 🟢 Close Modal
    Livewire.on('closeshowmodal', () => {
        const modalEl = document.getElementById('showModal');
        if (!modalEl) return;

        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();
    });

    // 🟢 OP Print Prescription
    Livewire.on('printprescription', (outpatientid) => {
        const modalEl = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        const url = `{{ url('/') }}/admin/printprescription/${outpatientid}`;
        window.open(url, '_blank');
    });

    // 🟢 OP Print Investigation
    Livewire.on('opprintinvestigation', (outpatientid) => {
        const modalEl = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        const url = `{{ url('/') }}/admin/opprintinvestigation/${outpatientid}`;
        window.open(url, '_blank');
    });

    // 🟢 OP Print Investigation Result
    Livewire.on('opprintinvestigationresult', (outpatientid) => {
        const modalEl = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        const url = `{{ url('/') }}/admin/opprintinvestigationresult/${outpatientid}`;
        window.open(url, '_blank');
    });

    // 🟢 IP Print Prescription
    Livewire.on('printipprescription', (ipassessmentid) => {
        const modalEl = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        const url = `{{ url('/') }}/admin/printipprescription/${ipassessmentid}`;
        window.open(url, '_blank');
    });

    // 🟢 IP Print Investigation
    Livewire.on('printipinvestigation', (ipassessmentid) => {
        const modalEl = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        const url = `{{ url('/') }}/admin/printipinvestigation/${ipassessmentid}`;
        window.open(url, '_blank');
    });

    // 🟢 IP Print Investigation Result
    Livewire.on('printipinvestigationresult', (ipassessmentid) => {
        const modalEl = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        const url = `{{ url('/') }}/admin/printipinvestigationresult/${ipassessmentid}`;
        window.open(url, '_blank');
    });

});
</script>

<!-- <script>
        window.livewire.on('showmodal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('showModal'))
            myModal.show();
        });
    </script>

    <script>
        // OP
        Livewire.on('printprescription', outpatientid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printprescription/" + outpatientid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });

        Livewire.on('opprintinvestigation', outpatientid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/opprintinvestigation/" + outpatientid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });

        Livewire.on('opprintinvestigationresult', outpatientid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/opprintinvestigationresult/" + outpatientid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });
        // IP
        Livewire.on('printipprescription', ipassessmentid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printipprescription/" + ipassessmentid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });

        Livewire.on('printipinvestigation', ipassessmentid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printipinvestigation/" + ipassessmentid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });

        Livewire.on('printipinvestigationresult', ipassessmentid => {
            $('#showModal').modal('hide');
            var url = "{{ url('/') }}" + "/admin/printipinvestigationresult/" + ipassessmentid;
            window.open(url);
            new bootstrap.Modal(document.getElementById('showModal')).show();
        });
        window.livewire.on('closeshowmodal', () => {
            $('#showModal').modal('hide');
        });
    </script> -->
@endsection