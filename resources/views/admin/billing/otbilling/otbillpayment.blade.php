@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="OT BILL PAYMENT" />
@endsection

@section('main-content')
    <div class="card col-sm-12 mx-auto border-0">
        <div class="card-body bg-light p-0">
            @can('Otpaybill')
                @livewire('admin.billing.otbilling.otbillpaymentlivewire', ['otbilling_uuid' => $otbilling_uuid])
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
    <script>
        Livewire.on('printotreceiptlist', receiptid => {
            var url = "{{ url('/') }}" + "/admin/otpaymentreceiptprint/" + receiptid;
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
