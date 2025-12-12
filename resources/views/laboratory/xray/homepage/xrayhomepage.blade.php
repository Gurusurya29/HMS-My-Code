@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        @include('laboratory.xray.xrayhelper.xrayhelpernav', ['name' => 'history'])
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body">
                Work in progress
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('#xraynav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
