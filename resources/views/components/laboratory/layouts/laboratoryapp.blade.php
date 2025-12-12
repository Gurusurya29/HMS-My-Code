<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title> Laboratory</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('image/logo/-Logo.png') }}">
    @livewireStyles
    <x-laboratory.layouts.laboratoryheader />
    <x-laboratory.layouts.laboratoryheaderlibrary />
</head>

<body>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <x-laboratory.layouts.laboratorytopnavbar />

    <div class="p-1">
        @section('main-content')
        @show
    </div>

    @livewireScripts
    <x-laboratory.layouts.laboratoryfooter />
    <x-laboratory.layouts.laboratoryfooterlibrary />
</body>

</html>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
       $(document).ready(function () {
        $('#tableid').DataTable();
    });
</script>
