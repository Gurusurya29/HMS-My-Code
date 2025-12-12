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
    // Livewire v3: Wrap all global listeners inside livewire:init
    document.addEventListener('livewire:init', () => {

        const modalElement = document.getElementById('showModal');
        
        // This helper function creates or gets the Bootstrap Modal instance.
        // It's crucial to call this consistently.
        const getModalInstance = () => {
            if (!modalElement) {
                console.error("Modal element with ID 'showModal' not found.");
                return null;
            }
            // Use getOrCreateInstance for showing, as it handles initialization
            return bootstrap.Modal.getOrCreateInstance(modalElement);
        };
        
        // This helper function gets the *existing* Bootstrap Modal instance.
        const getExistingModalInstance = () => {
            return bootstrap.Modal.getInstance(modalElement);
        };
        
        // --- 1. Event to SHOW the Modal ---
        Livewire.on('showModal', () => {
            const modalInstance = getModalInstance();
            if (modalInstance) {
                modalInstance.show();
            }
        });

        // --- 2. Event to CLOSE the Modal ---
        Livewire.on('closeshowmodal', () => {
            const modalInstance = getExistingModalInstance();
            // We check for existence first, as hide() can only be called on an existing instance.
            if (modalInstance) {
                modalInstance.hide();
            }
        });

        // --- 3. Helper Function for all Print Events ---
        const handlePrintEvent = (event, segment) => {
            const id = event.outpatientid || event.ipassessmentid;
            
            // Step 1: Hide the modal
            const modalInstance = getExistingModalInstance();
            if (modalInstance) {
                modalInstance.hide();
            }
            
            // Step 2: Open the print URL
            if (id) {
                // IMPORTANT: In Livewire 3, event payload is an object. 
                // Using window.location.origin is safer than relying on Blade's {{ url('/') }}
                const url = `${window.location.origin}/admin/${segment}/${id}`;
                window.open(url, '_blank'); // Open in a new tab/window
            }

            // Step 3: Re-show the modal (If this behavior is still desired)
            // Note: This often causes problems and might not be needed.
            // If you want the modal to automatically re-open, uncomment the lines below.
            /*
            const newModalInstance = getModalInstance();
            if (newModalInstance) {
                // Adding a small delay can sometimes help if the DOM is busy with the window.open call
                setTimeout(() => newModalInstance.show(), 500); 
            }
            */
        };
        
        // --- 4. Register all Print Listeners using the Helper ---
        // OP Listeners
        Livewire.on('printprescription', (event) => handlePrintEvent(event, 'printprescription'));
        Livewire.on('opprintinvestigation', (event) => handlePrintEvent(event, 'opprintinvestigation'));
        Livewire.on('opprintinvestigationresult', (event) => handlePrintEvent(event, 'opprintinvestigationresult'));
        
        // IP Listeners
        Livewire.on('printipprescription', (event) => handlePrintEvent(event, 'printipprescription'));
        Livewire.on('printipinvestigation', (event) => handlePrintEvent(event, 'printipinvestigation'));
        Livewire.on('printipinvestigationresult', (event) => handlePrintEvent(event, 'printipinvestigationresult'));
        
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