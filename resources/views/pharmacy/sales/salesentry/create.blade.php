@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    @include('pharmacy.sales.helper.salesnavheper', [
        'name' => 'salesentrycreate',
    ])

    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pharmacy.salesentryindex') }}">Sales</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Add/Edit</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Sales Entry</span></div>
                    <div class="bd-highlight d-flex gap-1">
                        @if ($prescriptionuuid)
                            <a href="{{ route('pharmacy.salesentrycreate') }}" style="width: 100px;"
                                class="btn btn-sm btn-primary shadow float-end mx-1">
                                Walk in
                            </a>
                        @else
                            <a href="{{ route('pharmacy.hmsprescriptionindex') }}"
                                class="btn btn-sm btn-primary shadow float-end mx-1">
                                HMS Prescription
                            </a>
                        @endif
                        <a href="{{ route('pharmacy.salesentryindex') }}"
                            class="btn btn-sm btn-warning shadow float-end mx-1">
                            Sales Entry List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @livewire('pharmacy.sales.salesentry.salesentrycreatelivewire', [
            'prescriptionuuid' => $prescriptionuuid,
        ])
    </div>
@endsection
@section('footerSection')
    <script type="text/javascript">
        window.livewire.on('productselected', () => {
            document.getElementById("batch").focus();
        });
        window.livewire.on('batchselected', () => {
            document.getElementById("quantity").focus();
        });
        window.livewire.on('cleanupfields', () => {
            document.getElementById("product").focus();
        });
        window.livewire.on('patientselected', () => {
            document.getElementById("prescription").focus();
        });
        window.livewire.on('prescriptionselected', () => {
            document.getElementById("product").focus();
        });
        window.livewire.on('doctorselected', () => {
            document.getElementById("product").focus();
        });
    </script>
    <script>
        $('#salesdropdown').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printsalesentry', salesentryid => {
            var url = "{{ url('/') }}" + "/pharmacy/salesentry/salesentryprint/" + salesentryid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
