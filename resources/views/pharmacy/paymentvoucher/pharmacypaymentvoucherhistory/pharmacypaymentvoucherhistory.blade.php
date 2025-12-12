@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="card  border-0">
        <div class="card-body bg-light p-0">

            <div class="col-md-6 mx-auto">
                @include('pharmacy.paymentvoucher.pharmacypaymentvoucherhelper.pharmacypaymentvouchernavbarhelper',
                    [
                        'name' => 'pharmacypaymentvoucherhistory',
                    ])
            </div>

            @livewire('pharmacy.paymentvoucher.pharmacypaymentvoucherhistory.pharmacypaymentvoucherhistorylivewire')
        </div>
    </div>
@endsection
@section('footerSection')
    <script>
        $('#paymentvoucher').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printpaymentvoucherentry', paymentvoucherid => {
            var url = "{{ url('/') }}" + "/pharmacy/paymentvoucher/pharmacypaymentvoucherprint/" +
                paymentvoucherid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
