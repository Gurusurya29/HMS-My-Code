@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OP BILL PAYMENT" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0 d-print-none">
        <div class="card-body bg-light p-0">
            @can('Oppaybill')
                @livewire('admin.billing.opbilling.opbillpaymentlivewire', ['opbilling_uuid' => $opbilling_uuid])
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
        Livewire.on('printopreceipt', receiptid => {
            var url = "{{ url('/') }}" + "/admin/printopreceipt/" + receiptid;
            window.open(url);
        });
    </script>
    <script>
        $(function() {
            window.livewire.on('balancealert', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Advance cannot be processed, please pay the outstanding balance',
                })
            });
        });
    </script>
@endsection
