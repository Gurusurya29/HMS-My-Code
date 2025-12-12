@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OT BILLING" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('Otbill')
                @livewire('admin.billing.otbilling.otbillingservicelivewire', ['otbilling_uuid' => $otbilling_uuid])
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 2,
        'collapsename' => '#patientbilling-collapse',
        'nameone' => '#patientbilling_mainmenu',
        'nametwo' => '#operationtheatrebilling_sidenav',
    ])
    <script type="text/javascript">
        // Discount
        window.livewire.on('otbillingdiscountmodal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('otbillingdiscountModal'))
            myModal.show();
        });
        window.livewire.on('closeaddservicemodal', () => {
            $('#otbillingdiscountModal').modal('hide');
        });
        var otbillingdiscountmodal = document.getElementById('otbillingdiscountModal')
        otbillingdiscountmodal.addEventListener('hidden.bs.modal', () => window.livewire.dispatch('discountresetfields'))

        Livewire.on('printotbill', otbillingid => {
            var url = "{{ url('/') }}" + "/admin/printotbill/" + otbillingid;
            window.open(url);
        });
    </script>
@endsection
