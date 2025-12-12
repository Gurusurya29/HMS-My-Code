@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
<x-admin.layouts.adminnavbar modulename="OUT PATIENT BILLING" />
@endsection

@section('main-content')
<div class="card col-sm-12 mx-auto border-0 d-print-none">
    <div class="card-body bg-light p-0">
        @can('OP-Billing')
        @livewire('admin.billing.opbilling.opbillinglivewire')
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

<script type="text/javascript">
    // Add Services
    Livewire.on('openaddservicemodal', () => {
        var myModal = new bootstrap.Modal(document.getElementById('addservicesModal'))
        myModal.show();
    });
    window.livewire.on('closeaddservicemodal', () => {
        $('#addservicesModal').modal('hide');
    });
    var addservicesModal = document.getElementById('addservicesModal')
    addservicesModal.addEventListener('hidden.bs.modal', () => window.livewire.dispatch(
        'addserviceresetfields'))
    // Bill Payment
    window.livewire.on('openopreceiptmodal', () => {
        var myModal = new bootstrap.Modal(document.getElementById('opreceiptModal'))
        myModal.show();
    });
    window.livewire.on('closeopreceiptmodal', () => {
        $('#opreceiptModal').modal('hide');
    });
    var opreceiptModal = document.getElementById('opreceiptModal')
    opreceiptModal.addEventListener('hidden.bs.modal', () => window.livewire.dispatch('paymentresetfields'))
</script>
<script>
    Livewire.on('printopreceipt', receiptid => {
        var url = "{{ url('/') }}" + "/printopreceipt/" + receiptid;
        window.open(url);
    });
    Livewire.on('printbillinglist', opbillinglistid => {
        var url = "{{ url('/') }}" + "/printbillinglist/" + opbillinglistid;
        window.open(url);
    });
</script>
@endsection