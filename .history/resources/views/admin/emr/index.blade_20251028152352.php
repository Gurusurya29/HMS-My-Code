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
    // 1. GLOBAL MODAL INITIALIZATION (RUNS ONCE)
    // Create the Bootstrap Modal instance and store it in a global variable.
    const myModal = new bootstrap.Modal(document.getElementById('showModal'), {
        backdrop: 'static', // Optional: prevents closing when clicking outside
        keyboard: false     // Optional: prevents closing with ESC
    });

    // Event listener to simply show the modal using the *initialized* instance.
    Livewire.on('showModal', () => {
        myModal.show(); // This will now work reliably on the first click
    });

    // Event listener to simply hide the modal using the *initialized* instance.
    Livewire.on('closeshowmodal', () => {
        myModal.hide();
    });
</script>

<script>
    // 2. PRINTING LOGIC

    // Helper function to handle the common hide-print-show sequence
    const handlePrintAndReopen = (endpoint, id) => {
        // Use the initialized myModal object to hide
        myModal.hide(); 
        
        var url = "{{ url('/') }}" + `/admin/${endpoint}/` + id;
        window.open(url);
        
        // Use a slight delay before re-showing to avoid focus conflicts 
        // with the newly opened print window.
        setTimeout(() => {
            myModal.show(); // Use the initialized myModal object to show
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