@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Expense</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.expense.expenseentry.expenseentryindexlivewire')
@endsection
@section('footerSection')
    <script>
        $('#expenseentry').addClass('border-bottom border-4 border-warning');
    </script>
    <script>
        Livewire.on('printotreceiptlist', expenseentryid => {
            var url = "{{ url('/') }}" + "/pharmacy/expenseentry/expenseentryreceiptprint/" + expenseentryid;
            window.open(url);
        });
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
