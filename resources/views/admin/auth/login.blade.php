<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('image/logo/-Logo.png') }}">
    <title>Hospital Management System</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-white">
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    @include('common.login.commonnav', ['name' => 'admin'])
    <div class="col-xl-8 mx-auto fw-bold">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-md-6 mx-auto col-lg-5">
                <h3 class="text-center">
                    {{ optional(App::make('generalsetting'))->companyfullname ?? 'Company Name' }}
                </h3>
                <form method="POST" action="{{ route('adminloginpost') }}"
                    class="p-4 p-md-5 border rounded-3 bg-light shadow" autocomplete="off">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="username" type="text"
                            class="form-control @error('username') is-invalid @enderror" id="floatingInput"
                            placeholder="name@example.com"
                            {{ env('APP_ENV') == 'local' ? 'value = admin' : ('value =' . old('username') ? old('username') : '') }}
                            required autofocus>
                        <label for="floatingInput">Username</label>
                        @error('username')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control" id=" floatingPassword"
                            placeholder="Password" name="password" required autocomplete="current-password"
                            {{ env('APP_ENV') == 'local' ? 'value =12345678' : '' }}>
                        <label for="floatingPassword">Password</label>
                        @error('password')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            Remember me
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>