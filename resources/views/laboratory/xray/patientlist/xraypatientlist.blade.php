@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @include('laboratory.xray.xrayhelper.xrayhelpernav', ['name' => 'patientlist'])

    </div>
    @livewire('laboratory.xray.patientlist.xraypatientlistlivewire')
@endsection

@section('footerSection')
    <script>
        $('#xraynav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
