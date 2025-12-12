@extends('components.laboratory.layouts.laboratoryapp')
@section('headSection')
@endsection

@section('main-content')
    <x-laboratory.layouts.laboratorybreadcrumb>
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('laboratorysettings') }}">Settings</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </x-laboratory.layouts.laboratorybreadcrumb>

    <div class="card m-2 shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">CHANGE PASSWORD</span>
                </div>
                <div class="bd-highlight">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('laboratorysettings') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body row g-3 mb-5">
            @livewire('laboratory.settings.user.changepassword.laboratorychangepasswordlivewire')
        </div>
    </div>
@endsection
@section('footerSection')
    <script>
        $('#settingnav').addClass('border-bottom border-4 border-warning');
    </script>
    @include('helper.modalhelper.livewiremodal')
@endsection
