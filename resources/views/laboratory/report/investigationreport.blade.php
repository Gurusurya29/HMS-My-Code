@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <x-.laboratory.layouts.laboratorybreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">
            Reports
        </li>
    </x-.laboratory.layouts.laboratorybreadcrumb>

    <div class="p-2">
        @php
            $user = auth()
                ->guard('laboratory')
                ->user();
        @endphp

        @if ($user->access_lab)
            @include('laboratory.report.inverstigationnavhelper.labreportnavhelper')
        @endif
        @if ($user->access_scan)
            @include('laboratory.report.inverstigationnavhelper.scanreportnavhelper')
        @endif
        @if ($user->access_xray)
            @include('laboratory.report.inverstigationnavhelper.xrayreportnavhelper')
        @endif
        @if ($user->isAdmin())
            @include('laboratory.report.inverstigationnavhelper.investigationreceiptnavhelper')
        @endif
    </div>
@endsection

@section('footerSection')
    <script>
        $('#reportnav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
