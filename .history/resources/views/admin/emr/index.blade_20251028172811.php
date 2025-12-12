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

    // Safely get Bootstrap modal instance or create one
    const getModal = () => {
        const modalElement = document.getElementById('showModal');
        if (!modalElement) {
            console.warn('❗ Modal element not found in DOM.');
            return null;
        }
        return bootstrap.Modal.getOrCreateInstance(modalElement);
    };

    // === Show Modal ===
    Livewire.on('showModal', () => {
        // Wait until Livewire fully re-renders new modal content
        Livewire.hook('message.processed', (message, component) => {
            const modal = getModal();
            if (modal) {
                // Remove possible aria-hidden issues
                modal._element.removeAttribute('aria-hidden');
                modal.show();
            }
        });
    });

    // === Close Modal ===
    Livewire.on('closeshowmodal', () => {
        const modal = getModal();
        if (modal) modal.hide();
    });

    // === Handle print events ===
    function handlePrint(url) {
        const modal = getModal();
        if (modal) modal.hide();
        window.open(url, '_blank');
    }

    // Outpatient
    Livewire.on('printprescription', id => {
        handlePrint(`{{ url('/') }}/admin/printprescription/${id}`);
    });
    Livewire.on('opprintinvestigation', id => {
        handlePrint(`{{ url('/') }}/admin/opprintinvestigation/${id}`);
    });
    Livewire.on('opprintinvestigationresult', id => {
        handlePrint(`{{ url('/') }}/admin/opprintinvestigationresult/${id}`);
    });

    // Inpatient
    Livewire.on('printipprescription', id => {
        handlePrint(`{{ url('/') }}/admin/printipprescription/${id}`);
    });
    Livewire.on('printipinvestigation', id => {
        handlePrint(`{{ url('/') }}/admin/printipinvestigation/${id}`);
    });
    Livewire.on('printipinvestigationresult', id => {
        handlePrint(`{{ url('/') }}/admin/printipinvestigationresult/${id}`);
    });
});
</script>
@endsection
