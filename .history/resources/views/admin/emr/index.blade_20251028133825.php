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
    document.addEventListener('livewire:init', () => {
        // ✅ SHOW MODAL
        Livewire.on('showModal', () => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
            modalInstance.show();
        });

        // ✅ CLOSE MODAL
        Livewire.on('closeshowmodal', () => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();
        });

        // ✅ OP PRINTS
        Livewire.on('printprescription', outpatientid => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();

            window.open(`${window.location.origin}/admin/printprescription/${outpatientid}`, '_blank');
        });

        Livewire.on('opprintinvestigation', outpatientid => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();

            window.open(`${window.location.origin}/admin/opprintinvestigation/${outpatientid}`, '_blank');
        });

        Livewire.on('opprintinvestigationresult', outpatientid => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();

            window.open(`${window.location.origin}/admin/opprintinvestigationresult/${outpatientid}`, '_blank');
        });

        // ✅ IP PRINTS
        Livewire.on('printipprescription', ipassessmentid => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();

            window.open(`${window.location.origin}/admin/printipprescription/${ipassessmentid}`, '_blank');
        });

        Livewire.on('printipinvestigation', ipassessmentid => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();

            window.open(`${window.location.origin}/admin/printipinvestigation/${ipassessmentid}`, '_blank');
        });

        Livewire.on('printipinvestigationresult', ipassessmentid => {
            const modalElement = document.getElementById('showModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();

            window.open(`${window.location.origin}/admin/printipinvestigationresult/${ipassessmentid}`, '_blank');
        });
    });
</script>
<!-- <script>
    Livewire.on('showModal', () => {
        const modal = new bootstrap.Modal(document.getElementById('showModal'));
        modal.show();
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
    Livewire.on('closeshowmodal', () => {
        $('#showModal').modal('hide');
    });
</script> -->
@endsection