@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body">
                @livewire('laboratory.report.labreport.labreportlivewire')
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('#reportnav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
