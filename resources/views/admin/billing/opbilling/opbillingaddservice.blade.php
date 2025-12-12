@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
<x-admin.layouts.adminnavbar modulename="OUT PATIENT BILLING" />
@endsection

@section('main-content')
<div class="card col-sm-12 mx-auto border-0 d-print-none">
    <div class="card-body bg-light p-0">
        @can('Opbill')
        @livewire('admin.billing.opbilling.opbillingaddservicelivewire', ['opbilling_uuid' => $opbilling_uuid])
        @endcan
    </div>
</div>
@endsection
@section('footerSection')
@include('helper.sidenavhelper.sidenavactive', [
'type' => 2,
'collapsename' => '#patientbilling-collapse',
'nameone' => '#patientbilling_mainmenu',
'nametwo' => '#outpatientbilling_sidenav',
])

<script>
    Livewire.on('printbillinglist', opbillinglistid => {
        var url = "{{ url('/') }}" + "/admin/printbillinglist/" + opbillinglistid;
        window.open(url);
    });
</script>
@endsection