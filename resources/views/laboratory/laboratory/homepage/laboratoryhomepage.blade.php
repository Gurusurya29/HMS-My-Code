@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @include('laboratory.laboratory.laboratoryhelper.laboratoryhelpernav', [
            'name' => 'laboratoryhomepage',
        ])

        @livewire('laboratory.laboratory.homepage.laboratoryhomepagelivewire')
    </div>
@endsection

@section('footerSection')
    <script>
        $('#laboratorynav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
