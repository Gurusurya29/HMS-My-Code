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
    // Livewire v3 uses document.addEventListener('livewire:init', ...)
    document.addEventListener('livewire:init', () => {
        const modalElement = document.getElementById('showModal');

        // Function to show the modal
        Livewire.on('showModal', () => {
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
            modalInstance.show();
        });

        // Function to close the modal
        Livewire.on('closeshowmodal', () => {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
                // Important: Livewire 3 will not re-render the modal content if it is conditionally rendered (@if ($showdata))
                // unless you explicitly nullify the data in your Livewire component on close.
                // The re-render will happen on the next 'showModal' event when $showdata is set.
            }
        });

        // Helper function for printing and closing modal
        const printAndCloseModal = (event, urlTemplate) => {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }

            const outpatientid = event.outpatientid || event.ipassessmentid;
            if (outpatientid) {
                const url = `${window.location.origin}/admin/${urlTemplate.replace('{id}', outpatientid)}`;
                window.open(url, '_blank');
            }
        };

        // ✅ OP PRINTS
        Livewire.on('printprescription', (event) => {
            printAndCloseModal(event, 'printprescription/{id}');
        });

        Livewire.on('opprintinvestigation', (event) => {
            printAndCloseModal(event, 'opprintinvestigation/{id}');
        });

        Livewire.on('opprintinvestigationresult', (event) => {
            printAndCloseModal(event, 'opprintinvestigationresult/{id}');
        });

        // ✅ IP PRINTS
        Livewire.on('printipprescription', (event) => {
            printAndCloseModal(event, 'printipprescription/{id}');
        });

        Livewire.on('printipinvestigation', (event) => {
            printAndCloseModal(event, 'printipinvestigation/{id}');
        });

        Livewire.on('printipinvestigationresult', (event) => {
            printAndCloseModal(event, 'printipinvestigationresult/{id}');
        });

        // Ensure the modal content is reset when the modal is fully hidden
        modalElement.addEventListener('hidden.bs.modal', function () {
            // Livewire will handle re-rendering when 'showModal' is emitted again
            // For complex cases, you might dispatch a Livewire call here to reset $showdata
        });
    });
</script>
<!-- <script>
    Livewire.on('showModal', () => {
        const modal = new bootstrap.Modal(document.getElementById('showModal'));
        modal.show();
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