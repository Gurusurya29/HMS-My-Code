@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body p-0">
                <div class="col-md-6 mx-auto">
                    @include('laboratory.receipt.investigationreceiptnavbarhelper', [
                        'name' => 'receipt',
                    ])
                </div>

                @livewire('laboratory.receipt.investigationreceiptlivewire')
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('#receiptnav').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printreceiptentry', receiptid => {
            var url = "{{ url('/') }}" + "/laboratory/printreceiptentry/" + receiptid;
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
