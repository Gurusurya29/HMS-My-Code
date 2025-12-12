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

        // Note: The error implies modalElement might be null when bootstrap runs init code.
        // By ensuring the modal HTML structure is always present, this check guarantees the element exists.
        if (!modalElement) {
            console.error("Bootstrap Modal element with ID 'showModal' not found.");
            return; // Stop execution if the element is missing
        }

        // Function to safely get or create the Bootstrap Modal instance
        const getModalInstance = () => {
            // getOrCreateInstance handles initialization (which was causing your classList error)
            return bootstrap.Modal.getOrCreateInstance(modalElement); 
        };

        // Function to get the existing Modal instance
        const getExistingModalInstance = () => {
            return bootstrap.Modal.getInstance(modalElement);
        };

        // ✅ SHOW MODAL
        Livewire.on('showModal', () => {
            getModalInstance().show();
        });

        // ✅ CLOSE MODAL
        Livewire.on('closeshowmodal', () => {
            const modalInstance = getExistingModalInstance();
            if (modalInstance) {
                modalInstance.hide();
            }
        });

        // Helper function for printing logic
        Livewire.on('printprescription', (event) => printAndCloseModal(event, 'printprescription'));
        Livewire.on('opprintinvestigation', (event) => printAndCloseModal(event, 'opprintinvestigation'));
        Livewire.on('opprintinvestigationresult', (event) => printAndCloseModal(event, 'opprintinvestigationresult'));
        Livewire.on('printipprescription', (event) => printAndCloseModal(event, 'printipprescription'));
        Livewire.on('printipinvestigation', (event) => printAndCloseModal(event, 'printipinvestigation'));
        Livewire.on('printipinvestigationresult', (event) => printAndCloseModal(event, 'printipinvestigationresult'));

        const printAndCloseModal = (event, segment) => {
            // Get the ID from the payload (Livewire v3 passes payload as an object)
            const id = event.outpatientid || event.ipassessmentid;
            
            // 1. Close the modal using the modern Bootstrap JS API
            const modalInstance = getExistingModalInstance();
            if (modalInstance) {
                modalInstance.hide();
            }
            
            // 2. Open the print window
            if (id) {
                const url = `${window.location.origin}/admin/${segment}/${id}`;
                window.open(url, '_blank');
            }
        };
    });
</script>
<!-- <script>
    livewire.on('showModal', () => {
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
    livewire.on('closeshowmodal', () => {
        $('#showModal').modal('hide');
    });
</script> -->
@endsection