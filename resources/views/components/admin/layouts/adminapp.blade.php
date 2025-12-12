<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('image/logo/-Logo.png') }}">
    <x-admin.layouts.adminheader />
    <x-admin.layouts.adminheaderlibrary />

</head>

<body>
    <div class="{{ session('sessiontoggled') }}" id="wrapper">
        @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
        <!-- Sidebar -->
        <x-admin.layouts.adminsidebar />
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="navbar-wrapper">
            @section('adminnavbar')
            @show
        </div>
        <section id="content-wrapper">
            @section('main-content')
            @show
        </section>
    </div>
    <!-- /#page-content-wrapper -->

    @livewireScripts
    <x-admin.layouts.adminfooterlibrary />

@stack('scripts') {{-- for your page-specific scripts --}}

</body>

</html>
<!-- <script>
    $(document).ready(function() {
        $('#tableid').DataTable();
    });
</script> -->