<div>
    @foreach ($wardtype as $type)
        <nav class="navbar navbar-dark theme_bg_color text-white">
            <div class="container-fluid">
                {{ $type->name }}
            </div>
        </nav>
        <div class="container">
            <div class="row">
                @forelse ($bedorroom->where('wardtype_id', $type->id)->all() as $eachroom)
                    @if ($eachroom->is_available == 0)
                        <div class="col-sm-1 p-1">
                            <div class="card m-1 bg-success text-white roomblock" id="{{ $eachroom->name }}">
                                <div class="card-body text-center" style="padding:  0.3rem;">
                                    <i class="bi bi-align-start " style="font-size: 1.5rem;"></i>
                                    <hr class="p-0 m-0">
                                    <span> {{ $eachroom->name }} </span>
                                </div>
                            </div>
                        </div>
                    @elseif ($eachroom->is_available == 1)
                        <div class="col-sm-1 p-1">
                            <div class="card m-1 bg-danger text-white roomblock" id="{{ $eachroom->name }}">
                                <div class="card-body text-center" style="padding:  0.3rem;">
                                    <i class="bi bi-align-start " style="font-size: 1.5rem;"></i>
                                    <hr class="p-0 m-0">
                                    <span> {{ $eachroom->name }} </span>
                                </div>
                            </div>
                        </div>
                    @elseif ($eachroom->is_available == 2)
                        <div class="col-sm-1 p-1">
                            <div class="card m-1 bg-warning text-dark roomblock" id="{{ $eachroom->name }}">
                                <div class="card-body text-center" style="padding:  0.3rem;">
                                    <i class="bi bi-align-start " style="font-size: 1.5rem;"></i>
                                    <hr class="p-0 m-0">
                                    <span> {{ $eachroom->name }} </span>
                                </div>
                            </div>
                        </div>
                    @elseif ($eachroom->is_available == 3)
                        <div class="col-sm-1 p-1">
                            <div class="card m-1 text-white roomblock" style="background-color: #ad1457;"
                                id="{{ $eachroom->name }}">
                                <div class="card-body text-center" style="padding:  0.3rem;">
                                    <i class="bi bi-align-start " style="font-size: 1.5rem;"></i>
                                    <hr class="p-0 m-0">
                                    <span> {{ $eachroom->name }} </span>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-center">--</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
