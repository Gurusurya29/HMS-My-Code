@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="PAYMENT VOUCHER" />
@endsection

@section('main-content')
    <div class="card  border-0">
        <div class="card-body bg-light p-0">

            <div class="col-md-6 mx-auto">
                @include('admin.account.paymentvoucher.paymentvoucherhelper.paymentvouchernavbarhelper', [
                    'name' => 'paymentvoucherhistory',
                ])
            </div>
            @can('Paymentvoucher-history')
                @livewire('admin.account.paymentvoucher.paymentvoucherhistory.paymentvoucherhistorylivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#paymentvoucher_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
    <script>
        Livewire.on('paymentvoucherprint', paymentvoucherid => {
            var url = "{{ url('/') }}" + "/admin/paymentvoucherprint/" + paymentvoucherid;
            window.open(url);
        });
    </script>
@endsection
