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


<script>
    // ----------------------------------------------------
    // Helper: Initialize and show the modal properly
    // ----------------------------------------------------
    function initAndShowModal() {
        const modalElement = document.getElementById('showModal');
        if (modalElement) {
            const modalInstance =
                bootstrap.Modal.getInstance(modalElement) ||
                new bootstrap.Modal(modalElement, {
                    backdrop: 'static',
                    keyboard: false,
                });
            modalInstance.show();
        }
    }

    // ----------------------------------------------------
    // Universal way to safely run code after DOM updates
    // ----------------------------------------------------
    function runAfterDomUpdate(callback) {
        if (typeof Livewire !== 'undefined' && typeof Livewire.hook === 'function') {
            // ✅ Livewire 3 or hybrid
            Livewire.hook('message.processed', () => callback());
        } else if (typeof window.livewire !== 'undefined' && typeof window.livewire.hook === 'function') {
            // ✅ Livewire 2
            window.livewire.hook('message.processed', () => callback());
        } else {
            // Fallback (no hook available)
            setTimeout(callback, 100);
        }
    }

    // ----------------------------------------------------
    // Show modal when Livewire dispatches "showModal"
    // ----------------------------------------------------
    Livewire.on('showModal', () => {
        runAfterDomUpdate(() => {
            initAndShowModal();
        });
    });

    // ----------------------------------------------------
    // Close modal when Livewire dispatches "closeshowmodal"
    // ----------------------------------------------------
    Livewire.on('closeshowmodal', () => {
        const modalElement = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
            modalInstance.hide();
        }
    });

    // ----------------------------------------------------
    // Generic function for print & reopen modal
    // ----------------------------------------------------
    function handlePrintAndReopen(endpoint, id) {
        const modalElement = document.getElementById('showModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) modalInstance.hide();

        const url = "{{ url('/') }}/admin/" + endpoint + "/" + id;
        window.open(url);

        // Reopen modal after short delay
        setTimeout(() => {
            initAndShowModal();
        }, 100);
    }

    // ----------------------------------------------------
    // OP (Out Patient) Print Events
    // ----------------------------------------------------
    Livewire.on('printprescription', (outpatientid) =>
        handlePrintAndReopen('printprescription', outpatientid)
    );
    Livewire.on('opprintinvestigation', (outpatientid) =>
        handlePrintAndReopen('opprintinvestigation', outpatientid)
    );
    Livewire.on('opprintinvestigationresult', (outpatientid) =>
        handlePrintAndReopen('opprintinvestigationresult', outpatientid)
    );

    // ----------------------------------------------------
    // IP (In Patient) Print Events
    // ----------------------------------------------------
    Livewire.on('printipprescription', (ipassessmentid) =>
        handlePrintAndReopen('printipprescription', ipassessmentid)
    );
    Livewire.on('printipinvestigation', (ipassessmentid) =>
        handlePrintAndReopen('printipinvestigation', ipassessmentid)
    );
    Livewire.on('printipinvestigationresult', (ipassessmentid) =>
        handlePrintAndReopen('printipinvestigationresult', ipassessmentid)
    );
</script>


@endsection