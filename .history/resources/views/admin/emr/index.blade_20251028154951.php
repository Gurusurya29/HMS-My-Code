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


<script>
    // Global variables to hold the modal instance and its initialization status
    let myModal = null;
    let isModalInitialized = false;

    // Helper function to initialize the modal only when the element is present, and only once.
    function initializeModal() {
        if (!isModalInitialized) {
            const modalElement = document.getElementById('showModal');
            if (modalElement) {
                // Initialize the modal instance only if the element exists
                myModal = new bootstrap.Modal(modalElement, {
                    backdrop: 'static',
                    keyboard: false
                });
                isModalInitialized = true;
            } else {
                // This message should no longer appear if the code below runs after DOMContentLoaded
                console.warn("Modal element with ID 'showModal' not found after initial render.");
                return false;
            }
        }
        return true;
    }

    // *** CRITICAL FIX: Ensure initialization only happens after the DOM is fully loaded ***
    // This is necessary because the Livewire component renders *before* the script runs.
    document.addEventListener('DOMContentLoaded', () => {
        initializeModal();
    });

    // 1. MODAL CONTROL

    // Listener for showing the modal
    Livewire.on('showModal', () => {
        // Try to get the initialized modal (it should already be initialized by DOMContentLoaded)
        if (!myModal && !initializeModal()) {
            // If still null, something is fundamentally wrong with the HTML placement/ID
            return;
        }

        // Use a slight delay (50ms) to allow Livewire time to update the content
        setTimeout(() => {
            myModal.show();
        }, 50);
    });

    // Listener for closing the modal
    Livewire.on('closeshowmodal', () => {
        if (myModal) {
            myModal.hide();
        }
    });

    // 2. PRINTING LOGIC

    const handlePrintAndReopen = (endpoint, id) => {
        // Try to get the initialized modal
        if (!myModal && !initializeModal()) {
            return;
        }

        if (myModal) {
            myModal.hide();
        }

        var url = "{{ url('/') }}" + `/admin/${endpoint}/` + id;
        window.open(url);

        // Delay before re-showing
        setTimeout(() => {
            if (myModal) {
                myModal.show();
            }
        }, 100);
    };

    // OP Print Events
    Livewire.on('printprescription', outpatientid => handlePrintAndReopen('printprescription', outpatientid));
    Livewire.on('opprintinvestigation', outpatientid => handlePrintAndReopen('opprintinvestigation', outpatientid));
    Livewire.on('opprintinvestigationresult', outpatientid => handlePrintAndReopen('opprintinvestigationresult', outpatientid));

    // IP Print Events
    Livewire.on('printipprescription', ipassessmentid => handlePrintAndReopen('printipprescription', ipassessmentid));
    Livewire.on('printipinvestigation', ipassessmentid => handlePrintAndReopen('printipinvestigation', ipassessmentid));
    Livewire.on('printipinvestigationresult', ipassessmentid => handlePrintAndReopen('printipinvestigationresult', ipassessmentid));
</script>
@endsection