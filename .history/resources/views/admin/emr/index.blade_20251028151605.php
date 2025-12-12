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
    // 1. MODAL INITIALIZATION AND CONTROL
    // Initialize the Bootstrap Modal once outside of any event listeners.
    // This creates a reusable instance that can be reliably shown and hidden.
    var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
        // Optional: Add options for better user experience
        backdrop: 'static', // Prevents closing when clicking outside
        keyboard: false     // Prevents closing with the ESC key
    });

    // Event listener to simply show the modal using the initialized instance
    Livewire.on('showModal', () => {
        myModal.show();
    });

    // Event listener to simply hide the modal using the initialized instance
    Livewire.on('closeshowmodal', () => {
        myModal.hide();
    });
</script>

---

<script>
    // 2. PRINTING LOGIC

    // Helper function to handle the common logic of hiding the modal, 
    // opening a new window for printing, and then re-showing the modal.
    const handlePrintAndReopen = (endpoint, id) => {
        // Hide the modal using the global instance
        myModal.hide(); 
        
        // Construct the URL and open the print window
        var url = "{{ url('/') }}" + `/admin/${endpoint}/` + id;
        window.open(url);
        
        // Use a short delay before re-showing the modal. This ensures 
        // the browser has time to focus on the new print window first, 
        // preventing potential focus issues.
        setTimeout(() => {
            myModal.show(); // Show the modal using the global instance
        }, 100); 
    };

    // OP Print Events
    Livewire.on('printprescription', outpatientid => {
        handlePrintAndReopen('printprescription', outpatientid);
    });

    Livewire.on('opprintinvestigation', outpatientid => {
        handlePrintAndReopen('opprintinvestigation', outpatientid);
    });

    Livewire.on('opprintinvestigationresult', outpatientid => {
        handlePrintAndReopen('opprintinvestigationresult', outpatientid);
    });

    // IP Print Events
    Livewire.on('printipprescription', ipassessmentid => {
        handlePrintAndReopen('printipprescription', ipassessmentid);
    });

    Livewire.on('printipinvestigation', ipassessmentid => {
        handlePrintAndReopen('printipinvestigation', ipassessmentid);
    });

    Livewire.on('printipinvestigationresult', ipassessmentid => {
        handlePrintAndReopen('printipinvestigationresult', ipassessmentid);
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