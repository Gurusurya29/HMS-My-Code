@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pharmacy.expenseentryindex') }}">Expense
                Entry</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add/Edit</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color">
                <div class="d-flex flex-row bd-highlight">
                    <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Expense Entry</span></div>
                    <div class="bd-highlight d-flex gap-1">
                        <a href="{{ route('pharmacy.expenseentryindex') }}"
                            class="btn btn-sm btn-warning shadow float-end mx-1">
                            Expense Entry List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @livewire('pharmacy.expense.expenseentry.expenseentrycreateoreditlivewire', ['expenseentryuuid' => $expenseentryuuid])
    </div>
@endsection
@section('footerSection')
    <script>
        $('#expenseentry').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
