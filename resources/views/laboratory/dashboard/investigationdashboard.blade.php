@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <a href="{{ route('laboratorypatientlist') }}" class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total Laboratory</h5>
                                    <hr>
                                    <h2 class="card-text"> {{ $labpatient }} </h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('xraypatientlist') }}" class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total X-Ray</h5>
                                    <hr>
                                    <h2 class="card-text">{{ $xraypatient }} </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('scanpatientlist') }}" class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total Scan</h5>
                                    <hr>
                                    <h2 class="card-text">{{ $scanpatient }} </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('investigationdashboard') }}"
                            class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total Investigation</h5>
                                    <hr>
                                    <h2 class="card-text">{{ $labpatient + $xraypatient + $scanpatient }} </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script>
        $('#homenav').addClass('border-bottom border-4 border-warning');
    </script>
@endsection
