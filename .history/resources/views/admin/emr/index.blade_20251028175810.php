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
    // Create modal instance once
    const showModalEl = document.getElementById('showModal');
    const showModalInstance = new bootstrap.Modal(showModalEl);

    Livewire.on('showmodal', () => {
        showModalInstance.show();
    });

    function openInPopupAndKeepModal(url) {
        // Open new tab/window
        window.open(url, '_blank');

        // Ensure the modal stays open after opening the popup
        showModalInstance.show();
    }

    // OP
    Livewire.on('printprescription', outpatientid => {
        showModalInstance.hide();
        openInPopupAndKeepModal("{{ url('/') }}/admin/printprescription/" + outpatientid);
    });

    Livewire.on('opprintinvestigation', outpatientid => {
        showModalInstance.hide();
        openInPopupAndKeepModal("{{ url('/') }}/admin/opprintinvestigation/" + outpatientid);
    });

    Livewire.on('opprintinvestigationresult', outpatientid => {
        showModalInstance.hide();
        openInPopupAndKeepModal("{{ url('/') }}/admin/opprintinvestigationresult/" + outpatientid);
    });

    // IP
    Livewire.on('printipprescription', ipassessmentid => {
        showModalInstance.hide();
        openInPopupAndKeepModal("{{ url('/') }}/admin/printipprescription/" + ipassessmentid);
    });

    Livewire.on('printipinvestigation', ipassessmentid => {
        showModalInstance.hide();
        openInPopupAndKeepModal("{{ url('/') }}/admin/printipinvestigation/" + ipassessmentid);
    });

    Livewire.on('printipinvestigationresult', ipassessmentid => {
        showModalInstance.hide();
        openInPopupAndKeepModal("{{ url('/') }}/admin/printipinvestigationresult/" + ipassessmentid);
    });

    Livewire.on('closeshowmodal', () => {
        showModalInstance.hide();
    });
</script>
@endsection