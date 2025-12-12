@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @livewire('laboratory.xray.patientlist.xrayresultentrylivewire', compact('uuid'))
    </div>
@endsection

@section('footerSection')
    <script>
        $('#xraynav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
