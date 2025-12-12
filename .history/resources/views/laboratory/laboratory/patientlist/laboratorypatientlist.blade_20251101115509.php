@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @include('laboratory.laboratory.laboratoryhelper.laboratoryhelpernav', ['name' => 'patientlist'])

    </div>
    @livewire('Laboratory.Laboratory.patientlist.laboratorypatientlistlivewire')
@endsection

@section('footerSection')
    <script>
        $('#laboratorynav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
