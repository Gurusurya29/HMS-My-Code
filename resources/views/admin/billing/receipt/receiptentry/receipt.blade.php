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
                    'name' => 'receipt',
                ])
            </div>
            @can('Receipt-entry')
                @livewire('admin.billing.receipt.receiptentry.receiptlivewire')
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
    <script>
        Livewire.on('printreceiptentry', receiptid => {
            var url = "{{ url('/') }}" + "/admin/printreceiptentry/" + receiptid;
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
