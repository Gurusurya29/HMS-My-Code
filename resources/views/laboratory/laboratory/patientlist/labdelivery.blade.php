@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @livewire('laboratory.laboratory.patientlist.labdeliverylivewire', compact('uuid'))
    </div>
@endsection

@section('footerSection')
    <script>
        $('#laboratorynav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
