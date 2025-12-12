@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="RECEIPT" />
@endsection

@section('main-content')
    <div class="card  border-0">
        <div class="card-body bg-light p-0">

            <div class="col-md-6 mx-auto">
                @include('admin.billing.receipt.receipthelper.receiptnavbarhelper', [
                    'name' => 'receipthistory',
                ])
            </div>
            @can('Receipt-history')
                @livewire('admin.billing.receipt.receipthistory.receipthistorylivewire')
            @endcan
        </div>
    </div>
@endsection
@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 2,
        'collapsename' => '#patientbilling-collapse',
        'nameone' => '#patientbilling_mainmenu',
        'nametwo' => '#receipt_sidenav',
    ])
    @include('helper.modalhelper.livewiremodal')
    <script>
        Livewire.on('printreceiptentry', receiptid => {
            var url = "{{ url('/') }}" + "/admin/printreceiptentry/" + receiptid;
            window.open(url);
        });
    </script>
@endsection
