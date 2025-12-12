@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.sales.salesreturn.salesreturnnav', [
        'name' => 'salesreturncreate',
    ])

    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pharmacy.salesreturnindex') }}">Sales</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Return</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Sales Return</span></div>
                    <div class="bd-highlight d-flex gap-1">
                        <a href="{{ route('pharmacy.salesreturnindex') }}"
                            class="btn btn-sm btn-warning shadow float-end mx-1">
                            Sales Return List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @livewire('pharmacy.sales.salesreturn.salesreturncreatelivewire')
    </div>
@endsection
@section('footerSection')
    <script type="text/javascript">
        window.livewire.on('patientselected', () => {
            document.getElementById("sale").focus();
        });
    </script>
    <script>
        $('#salesdropdown').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
