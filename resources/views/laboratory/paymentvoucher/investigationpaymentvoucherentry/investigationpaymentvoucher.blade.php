@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        <div class="card  border-0">
            <div class="card-body bg-light p-0">

                <div class="col-md-6 mx-auto">
                    @include('laboratory.paymentvoucher.investigationpaymentvoucherhelper.investigationpaymentvouchernavbarhelper',
                        [
                            'name' => 'investigationpaymentvoucherentry',
                        ])
                </div>

                @livewire('laboratory.paymentvoucher.investigationpaymentvoucherentry.investigationpaymentvoucherentrylivewire')
            </div>
        </div>
    </div>
@endsection
@section('footerSection')
    <script>
        $('#paymentvoucher_nav').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('investigationvoucherprint', investigationvoucherid => {
            var url = "{{ url('/') }}" + "/laboratory/investigationvoucherprint/" + investigationvoucherid;
            window.open(url);
        });
    </script>
@endsection
