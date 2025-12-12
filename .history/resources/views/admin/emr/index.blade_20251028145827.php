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

        // Function to safely get or create the Bootstrap Modal instance
        const getModalInstance = () => {
            return bootstrap.Modal.getOrCreateInstance(modalElement);
        };

        // Function to get the existing Modal instance
        const getExistingModalInstance = () => {
            return bootstrap.Modal.getInstance(modalElement);
        };

        // ✅ SHOW MODAL: Use uppercase 'Livewire.on' inside the init block
        // Note: Livewire.on in v3 still works for simple events, but dispatch/listen is preferred.
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
        const printAndCloseModal = (event) => {
            // Get the ID from the payload (Livewire v3 passes payload as an object, $event)
            const id = event.outpatientid || event.ipassessmentid;

            // 1. Close the modal using the modern Bootstrap JS API
            const modalInstance = getExistingModalInstance();
            if (modalInstance) {
                modalInstance.hide();
            }

            // 2. Open the print window
            if (id) {
                let url;
                if (event.name === 'printprescription') {
                    url = `${window.location.origin}/admin/printprescription/${id}`;
                } else if (event.name === 'opprintinvestigation') {
                    url = `${window.location.origin}/admin/opprintinvestigation/${id}`;
                } else if (event.name === 'opprintinvestigationresult') {
                    url = `${window.location.origin}/admin/opprintinvestigationresult/${id}`;
                } else if (event.name === 'printipprescription') {
                    url = `${window.location.origin}/admin/printipprescription/${id}`;
                } else if (event.name === 'printipinvestigation') {
                    url = `${window.location.origin}/admin/printipinvestigation/${id}`;
                } else if (event.name === 'printipinvestigationresult') {
                    url = `${window.location.origin}/admin/printipinvestigationresult/${id}`;
                }

                if (url) {
                    window.open(url, '_blank');
                }
            }

            // 3. Re-show the modal after printing if needed (not usually necessary, but keeping it if it matches your old logic)
            // If you need the modal to reappear after the print window opens/closes, uncomment the line below.
            // getModalInstance().show(); 
        };

        // Re-map all the print events to the new handler
        Livewire.on('printprescription', printAndCloseModal);
        Livewire.on('opprintinvestigation', printAndCloseModal);
        Livewire.on('opprintinvestigationresult', printAndCloseModal);
        Livewire.on('printipprescription', printAndCloseModal);
        Livewire.on('printipinvestigation', printAndCloseModal);
        Livewire.on('printipinvestigationresult', printAndCloseModal);

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