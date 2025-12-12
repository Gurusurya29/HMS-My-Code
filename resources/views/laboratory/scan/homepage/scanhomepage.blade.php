@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @include('laboratory.scan.scanhelper.scanhelpernav', ['name' => 'history'])
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body">
                Work in progress
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('#scannav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
