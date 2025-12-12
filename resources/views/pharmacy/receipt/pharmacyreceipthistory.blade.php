@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    @include('pharmacy.receipt.pharmacyreceiptnavbarhelper', [
                        'name' => 'receipthistory',
                    ])
                </div>
                @livewire('pharmacy.receipt.pharmacyreceipthistorylivewire')

            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('#receiptnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
    <script>
        Livewire.on('printreceiptentry', receiptid => {
            var url = "{{ url('/') }}" + "/pharmacy/receipt/printreceiptentry/" + receiptid;
            window.open(url);
        });
    </script>
@endsection
