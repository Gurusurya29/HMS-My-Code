@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @include('laboratory.scan.scanhelper.scanhelpernav', ['name' => 'history'])

    </div>
    @livewire('laboratory.scan.patienthistory.scanpatienthistorylivewire')
@endsection

@section('footerSection')
    <script>
        $('#scannav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
