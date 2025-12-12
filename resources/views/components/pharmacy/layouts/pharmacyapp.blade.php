<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title> Pharmacy</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('image/logo/-Logo.png') }}">
    @livewireStyles
    <x-pharmacy.layouts.pharmacyheader />
    <x-pharmacy.layouts.pharmacyheaderlibrary />
</head>

<body>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <x-pharmacy.layouts.pharmacytopnavbar />

    <div class="p-4">
        @livewire('pharmacy.common.hsmalertlivewire')
        @section('main-content')
        @show
    </div>

    @livewireScripts
    <x-pharmacy.layouts.pharmacyfooter />
    <x-pharmacy.layouts.pharmacyfooterlibrary />
</body>

</html>
