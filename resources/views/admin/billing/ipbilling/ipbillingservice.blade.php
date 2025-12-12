@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="IP BILLING" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('Ipbill')
                @livewire('admin.billing.ipbilling.ipbillingservicelivewire', ['ipbilling_uuid' => $ipbilling_uuid])
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 2,
        'collapsename' => '#patientbilling-collapse',
        'nameone' => '#patientbilling_mainmenu',
        'nametwo' => '#inpatientbilling_sidenav',
    ])
    <script type="text/javascript">
        // Discount
        window.livewire.on('ipbillingdiscountmodal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('ipbillingdiscountModal'))
            myModal.show();
        });
        window.livewire.on('closeaddservicemodal', () => {
            $('#ipbillingdiscountModal').modal('hide');
        });
        var ipbillingdiscountmodal = document.getElementById('ipbillingdiscountModal')
        ipbillingdiscountmodal.addEventListener('hidden.bs.modal', () => window.livewire.dispatch('discountresetfields'))

        Livewire.on('printdetailedipbill', ipbillingid => {
            var url = "{{ url('/') }}" + "/admin/printdetailedipbill/" + ipbillingid;
            window.open(url);
        });
        Livewire.on('printconsolidatedipbill', ipbillingid => {
            var url = "{{ url('/') }}" + "/admin/printconsolidatedipbill/" + ipbillingid;
            window.open(url);
        });
    </script>
@endsection
