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
    // Livewire v3: Wrap listeners inside 'livewire:init' to ensure Livewire is ready
    document.addEventListener('livewire:init', () => {

        const modalElement = document.getElementById('showModal');
        if (!modalElement) {
            console.error("Bootstrap Modal element with ID 'showModal' not found.");
            return; // Stop if the element is missing
        }

        // Helper to get or create the modal instance safely (Fixes first-click issue)
        const getModalInstance = () => {
            return bootstrap.Modal.getOrCreateInstance(modalElement);
        };

        // Helper to get the existing modal instance for actions like hide
        const getExistingModalInstance = () => {
            return bootstrap.Modal.getInstance(modalElement);
        };

        // --- 1. SHOW Modal Event ---
        Livewire.on('showModal', () => {
            getModalInstance().show();
        });

        // --- 2. CLOSE Modal Event ---
        // Uses native Bootstrap JS hide() (Replaces $('#showModal').modal('hide'))
        Livewire.on('closeshowmodal', () => {
            const modalInstance = getExistingModalInstance();
            if (modalInstance) {
                modalInstance.hide();
            }
        });

        // --- 3. Centralized Print Handler Function ---
        const handlePrintEvent = (id, segment) => {
            // Step 1: Hide the modal (using native Bootstrap JS)
            const modalInstanceToHide = getExistingModalInstance();
            if (modalInstanceToHide) {
                modalInstanceToHide.hide();
            }

            // Step 2: Open the print URL
            if (id) {
                // Construct the URL dynamically without relying on Blade's {{ url('/') }} inside JS
                const url = `${window.location.origin}/admin/${segment}/${id}`;
                window.open(url, '_blank');
            }

            // Step 3: Re-show the modal (Kept to match your original logic)
            const modalInstanceToShow = getModalInstance();
            if (modalInstanceToShow) {
                // Add a small delay to prevent conflicts with the window.open call
                setTimeout(() => modalInstanceToShow.show(), 300);
            }
        };

        // --- 4. Register all Print Listeners ---

        // OP Listeners: Pass the ID and the URL segment to the handler
        Livewire.on('printprescription', (outpatientid) => handlePrintEvent(outpatientid, 'printprescription'));
        Livewire.on('opprintinvestigation', (outpatientid) => handlePrintEvent(outpatientid, 'opprintinvestigation'));
        Livewire.on('opprintinvestigationresult', (outpatientid) => handlePrintEvent(outpatientid, 'opprintinvestigationresult'));

        // IP Listeners: Pass the ID and the URL segment to the handler
        Livewire.on('printipprescription', (ipassessmentid) => handlePrintEvent(ipassessmentid, 'printipprescription'));
        Livewire.on('printipinvestigation', (ipassessmentid) => handlePrintEvent(ipassessmentid, 'printipinvestigation'));
        Livewire.on('printipinvestigationresult', (ipassessmentid) => handlePrintEvent(ipassessmentid, 'printipinvestigationresult'));

    });
</script>
<!-- <script>
    Livewire.on('showModal', () => {
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
    Livewire.on('closeshowmodal', () => {
        $('#showModal').modal('hide');
    });
</script> -->
@endsection