@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    @include('pharmacy.receipt.pharmacyreceiptnavbarhelper', [
                        'name' => 'receipt',
                    ])
                </div>

                @livewire('pharmacy.receipt.pharmacyreceiptlivewire')
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('#receiptentry').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printreceiptentry', receiptid => {
            var url = "{{ url('/') }}" + "/pharmacy/receipt/printreceiptentry/" + receiptid;
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
