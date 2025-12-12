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


<script>
document.addEventListener('livewire:load', () => {
    const modalEl = document.getElementById('showModal');
    const modal = new bootstrap.Modal(modalEl);

    // Helper to safely show modal after Livewire finishes updating
    function safeShowModal() {
        setTimeout(() => {
            modal.show();
        }, 200); // small delay lets Livewire render content
    }

    // When showModal event is emitted from Livewire
    Livewire.on('showModal', () => {
        safeShowModal();
    });

    // When Livewire tells modal to close
    Livewire.on('closeshowmodal', () => {
        modal.hide();
    });

    // ---- PRINT EVENTS ----
    function handlePrint(endpoint, id) {
        modal.hide();
        const url = `${"{{ url('/') }}"}/admin/${endpoint}/${id}`;
        window.open(url);
        safeShowModal();
    }

    // Outpatient
    Livewire.on('printprescription', id => handlePrint('printprescription', id));
    Livewire.on('opprintinvestigation', id => handlePrint('opprintinvestigation', id));
    Livewire.on('opprintinvestigationresult', id => handlePrint('opprintinvestigationresult', id));

    // Inpatient
    Livewire.on('printipprescription', id => handlePrint('printipprescription', id));
    Livewire.on('printipinvestigation', id => handlePrint('printipinvestigation', id));
    Livewire.on('printipinvestigationresult', id => handlePrint('printipinvestigationresult', id));
});
</script>



@endsection