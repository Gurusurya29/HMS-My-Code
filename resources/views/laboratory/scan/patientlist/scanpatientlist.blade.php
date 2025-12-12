@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @include('laboratory.scan.scanhelper.scanhelpernav', ['name' => 'patientlist'])

    </div>
    @livewire('laboratory.scan.patientlist.scanpatientlistlivewire')
@endsection

@section('footerSection')
    <script>
        $('#scannav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
