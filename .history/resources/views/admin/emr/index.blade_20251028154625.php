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
    // Global variable to hold the modal instance and a flag to track initialization
    let myModal = null;
    let isModalInitialized = false;

    // Helper function to get or create the modal instance
    function getInitializedModal() {
        if (!isModalInitialized) {
            const modalElement = document.getElementById('showModal');
            if (modalElement) {
                // Initialize only if the element exists in the DOM
                myModal = new bootstrap.Modal(modalElement, {
                    backdrop: 'static',
                    keyboard: false
                });
                isModalInitialized = true;
            } else {
                // Log a warning if the element is not found, preventing the TypeError
                console.warn("Modal element with ID 'showModal' not found in the DOM.");
            }
        }
        return myModal;
    }
    
    // Listener for showing the modal
    Livewire.on('showModal', () => {
        const modalInstance = getInitializedModal();
        if (modalInstance) {
            // Use a slight delay (50ms) to allow Livewire time to render data
            setTimeout(() => {
                modalInstance.show();
            }, 50);
        }
    });

    // Listener for closing the modal
    Livewire.on('closeshowmodal', () => {
        const modalInstance = getInitializedModal();
        if (modalInstance) {
            modalInstance.hide();
        }
    });

    // 2. PRINTING LOGIC (Refactored and Corrected)
    const handlePrintAndReopen = (endpoint, id) => {
        const modalInstance = getInitializedModal();
        if (modalInstance) {
            modalInstance.hide(); 
        }
        
        var url = "{{ url('/') }}" + `/admin/${endpoint}/` + id;
        window.open(url);
        
        setTimeout(() => {
            if (modalInstance) {
                modalInstance.show();
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