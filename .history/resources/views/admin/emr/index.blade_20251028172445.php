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
document.addEventListener('livewire:load', () => {

    // ✅ SHOW MODAL
    Livewire.on('showModal', () => {
        Livewire.hook('message.processed', () => {
            const modalEl = document.getElementById('showModal');
            if (!modalEl) {
                console.error('Modal element not found.');
                return;
            }
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        });
    });

    // ✅ CLOSE MODAL
    Livewire.on('closeshowmodal', () => {
        const modalEl = document.getElementById('showModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    });

    // ✅ PRINT HANDLERS (no jQuery, Bootstrap 5 syntax)
    Livewire.on('printprescription', outpatientid => {
        const modalEl = document.getElementById('showModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        const url = `{{ url('/') }}/admin/printprescription/${outpatientid}`;
        window.open(url);
    });

    Livewire.on('opprintinvestigation', outpatientid => {
        const modalEl = document.getElementById('showModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        const url = `{{ url('/') }}/admin/opprintinvestigation/${outpatientid}`;
        window.open(url);
    });

    Livewire.on('opprintinvestigationresult', outpatientid => {
        const modalEl = document.getElementById('showModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        const url = `{{ url('/') }}/admin/opprintinvestigationresult/${outpatientid}`;
        window.open(url);
    });

    Livewire.on('printipprescription', ipassessmentid => {
        const modalEl = document.getElementById('showModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        const url = `{{ url('/') }}/admin/printipprescription/${ipassessmentid}`;
        window.open(url);
    });

    Livewire.on('printipinvestigation', ipassessmentid => {
        const modalEl = document.getElementById('showModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        const url = `{{ url('/') }}/admin/printipinvestigation/${ipassessmentid}`;
        window.open(url);
    });

    Livewire.on('printipinvestigationresult', ipassessmentid => {
        const modalEl = document.getElementById('showModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        const url = `{{ url('/') }}/admin/printipinvestigationresult/${ipassessmentid}`;
        window.open(url);
    });
});
</script>
@endsection
