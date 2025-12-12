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
    function getModal(id) {
        const el = document.getElementById(id);
        if (!el) return null;
        // Ensure you're using the correct framework (Bootstrap 5 in this case)
        return bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
    }

    // --- Start of Correction ---
    // A flag to track if the 'showmodal' event has been triggered yet.
    let isFirstShowModal = true; 

  Livewire.on('showmodal', () => {
        if (isFirstShowModal) {
            console.log("First 'View' button click (globally) ignored.");
            isFirstShowModal = false; // Disable the flag for all future calls
            return; // EXIT: Prevents modal from showing on the first event
        }
        
        // Subsequent calls: proceed to show the modal
        const modal = getModal('showModal');
        if (modal) modal.show();
    });

    // --- End of Correction ---

    // The rest of your code remains the same for the printing functionality

    // OP
    Livewire.on('printprescription', outpatientid => {
        const modal = getModal('showModal');
        if (modal) modal.hide();

        window.open("{{ url('/') }}/admin/printprescription/" + outpatientid);

        if (modal) modal.show();
    });

    Livewire.on('opprintinvestigation', outpatientid => {
        const modal = getModal('showModal');
        if (modal) modal.hide();

        window.open("{{ url('/') }}/admin/opprintinvestigation/" + outpatientid);

        if (modal) modal.show();
    });

    Livewire.on('opprintinvestigationresult', outpatientid => {
        const modal = getModal('showModal');
        if (modal) modal.hide();

        window.open("{{ url('/') }}/admin/opprintinvestigationresult/" + outpatientid);

        if (modal) modal.show();
    });

    // IP
    Livewire.on('printipprescription', ipassessmentid => {
        const modal = getModal('showModal');
        if (modal) modal.hide();

        window.open("{{ url('/') }}/admin/printipprescription/" + ipassessmentid);

        if (modal) modal.show();
    });

    Livewire.on('printipinvestigation', ipassessmentid => {
        const modal = getModal('showModal');
        if (modal) modal.hide();

        window.open("{{ url('/') }}/admin/printipinvestigation/" + ipassessmentid);

        if (modal) modal.show();
    });

    Livewire.on('printipinvestigationresult', ipassessmentid => {
        const modal = getModal('showModal');
        if (modal) modal.hide();

        window.open("{{ url('/') }}/admin/printipinvestigationresult/" + ipassessmentid);

        if (modal) modal.show();
    });

    Livewire.on('closeshowmodal', () => {
        const modal = getModal('showModal');
        if (modal) modal.hide();
    });
</script>
@endsection