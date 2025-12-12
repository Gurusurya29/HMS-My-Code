@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <x-pharmacy.layouts.pharmacybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('pharmacysettings') }}">Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add User</li>
    </x-pharmacy.layouts.pharmacybreadcrumb>

    @livewire('pharmacy.settings.user.adduser.addpharmacyuserlivewire')
@endsection
@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
