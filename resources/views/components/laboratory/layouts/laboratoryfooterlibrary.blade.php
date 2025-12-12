<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset('js/texteditor/ckeditor.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert', ({
        detail: {
            type,
            message
        }
    }) => {
        Toast.fire({
            icon: type,
            title: message
        })
    })
</script>
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<style>
    .form-check-input {
        clear: left;
    }

    .form-switch.form-switch-sm {
        margin-bottom: 0.5rem;
        /* JUST FOR STYLING PURPOSE */
    }

    .form-switch.form-switch-sm .form-check-input {
        height: 1rem;
        width: calc(1rem + 0.75rem);
        border-radius: 2rem;
    }

    .form-switch.form-switch-md {
        margin-bottom: 1rem;
        /* JUST FOR STYLING PURPOSE */
    }

    .form-switch.form-switch-md .form-check-input {
        height: 1.5rem;
        width: calc(2rem + 0.75rem);
        border-radius: 3rem;
    }

    .form-switch.form-switch-lg {
        margin-bottom: 1.5rem;
        /* JUST FOR STYLING PURPOSE */
    }

    .form-switch.form-switch-lg .form-check-input {
        height: 2rem;
        width: calc(3rem + 0.75rem);
        border-radius: 4rem;
    }

    .form-switch.form-switch-xl {
        margin-bottom: 2rem;
        /* JUST FOR STYLING PURPOSE */
    }

    .form-switch.form-switch-xl .form-check-input {
        height: 2.5rem;
        width: calc(4rem + 0.75rem);
        border-radius: 5rem;
    }
</style>
@section('footerSection')
@show
