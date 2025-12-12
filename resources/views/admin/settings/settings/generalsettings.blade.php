@can('General-Menu')
    <h5>General Settings</h5>
    <div class="pb-4 pt-2">
        <div class="row g-3 row-cols-1 row-cols-md-2">
            @can('General')
                <div class="col-md-2">
                    <a href="{{ route('generalsetting') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <i class="bi bi-gear" style="font-size: 2.4rem;"></i>
                            <div class="card-footer">
                                <div class="fw-b"> General Settings</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            {{-- <div class="col-md-2">
            <a href="{{ route('emailsetting') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-envelope" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Email Settings </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('smssetting') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-card-text" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">SMS Settings </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('gatewaysetting') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-credit-card" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Gateway Settings </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('fcmsetting') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-google" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">FCM Settings </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('themesetting') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-palette" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Theme Settings </div>
                    </div>
                </div>
            </a>
        </div> --}}
        </div>
    </div>
@endcan
