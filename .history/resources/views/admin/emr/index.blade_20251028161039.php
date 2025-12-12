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
    // Global variable for the modal instance
    window.myModal = window.myModal || null;

    window.addEventListener('show-modal', () => {
        initAndShowModal();
    });
    Livewire.on('showmodal', () => {
        Livewire.nextTick(() => {
            initAndShowModal();
        });
    });

    /**
     * Initializes the modal instance if it doesn't exist, and then shows it.
     * This function is called from the Livewire component after data is loaded.
     */
    function initAndShowModal() {
        // Initialization Logic
        if (!window.myModal) {
            const modalElement = document.getElementById("showModal");
            // NOTE: Check for modalElement is critical here
            if (modalElement) {
                // Initialize the Bootstrap Modal instance once
                window.myModal = new bootstrap.Modal(modalElement, {
                    backdrop: 'static',
                    keyboard: false
                });
            }
        }

        // Show Logic (with a slight delay to ensure rendering)
        if (window.myModal) {
            setTimeout(() => {
                window.myModal.show();
            }, 50);
        }
    }


    // Listener for closing the modal
    Livewire.on('closeshowmodal', () => {
        if (window.myModal) {
            window.myModal.hide();
        }
    });

    // OP & IP PRINTING LOGIC (Remains the same, relying on window.myModal)

    const handlePrintAndReopen = (endpoint, id) => {
        if (window.myModal) {
            window.myModal.hide();
        }

        var url = "{{ url('/') }}" + `/admin/${endpoint}/` + id;
        window.open(url);

        // Delay before re-showing
        setTimeout(() => {
            if (window.myModal) {
                window.myModal.show();
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