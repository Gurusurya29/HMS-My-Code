@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @livewire('laboratory.scan.patientlist.scanresultentrylivewire', compact('uuid'))
    </div>
@endsection

@section('footerSection')
    <script>
        $('#scannav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
