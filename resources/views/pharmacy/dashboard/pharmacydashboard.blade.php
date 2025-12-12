@extends('components.pharmacy.layouts.pharmacyapp')
@section('headSection')
@endsection

@section('main-content')
    <div class="container">
        <div class="card mx-auto border-0 bg-light">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <a class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total Product</h5>
                                    <hr>
                                    <h2 class="card-text">
                                        {{ $totalprods }}
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sales Today</h5>
                                    <hr>
                                    <h2 class="card-text">
                                        {{ $totalsalestoday }}
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sales This Week</h5>
                                    <hr>
                                    <h2 class="card-text">
                                        {{ $totalsalesweek }}
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="text-decoration-none text-dark text-center">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sales This Month</h5>
                                    <hr>
                                    <h2 class="card-text">
                                        {{ $totalsalesmonth }}
                                    </h2>
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
