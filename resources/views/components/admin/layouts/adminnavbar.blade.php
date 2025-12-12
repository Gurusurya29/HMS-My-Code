<nav class="navbar navbar-expand-lg  theme_bg_color py-0 px-4 navbar-dark rounded">
    <div class="container-fluid">
        <div class="navbar-brand d-flex align-items-center">
            <a href="#" class="" id="sidebar-toggle">
                <i class="bi bi-text-left text-white fs-2 me-3" style="font-weight: bold;"></i>
            </a>
            <h2 class="fs-4 m-0 text-white ms-5">{{ $modulename }}</h2>
        </div>

        <h1 class="fs-3 m-0  ms-5 text-center text-warning">
            {{ App::make('generalsetting')->companyfullname }}</h1>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


                <li class="nav-item dropdown" style="margin-right:50px;">
                    <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill me-2 fs-5"></i>{{ Auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <div class="p-3 border-bottom">
                                <span>{{ Auth()->user()->name }}</span>
                                <span class="text-secondary">{{ Auth()->user()->email }}</span>
                            </div>
                        </li>
                        {{-- <li><a class="dropdown-item" href="{{ route('usercreateoredit') }}">Profile</a></li> --}}
                        <li><a class="dropdown-item" href="{{ route('userchangepassword') }}">Change Password</a>
                        </li>
                        {{-- <li><a class="dropdown-item" href="{{ route('2fa') }}">2FA</a></li> --}}
                        <li><a class="dropdown-item" href="{{ route('adminlogout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('postadminlogout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>
