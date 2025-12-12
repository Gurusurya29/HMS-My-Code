<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/texteditor/ckeditor.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@stack('scripts')
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



<script>
    const $button = document.querySelector('#sidebar-toggle');
    const $wrapper = document.querySelector('#wrapper');
    $button.addEventListener('click', (e) => {
        e.preventDefault();
        $wrapper.classList.toggle('toggled');
    });
</script>


<style type="text/css">
    .fa-spin {
        display: none;
    }
</style>
<script type="text/javascript">
    (function() {
        $('.form_prevent_multiple_submits').on('submit', function() {
            $('.button_prevent_multiple_submits').attr('disabled', 'true');
            $('.fa-spin').show();
        })
    })();
</script>
<script>
    $(document).ready(function() {
        $('#sidebar-toggle').click(function(e) {
            $.get("{{ URL('/admin/session') }}");
        });
    });
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
    .georgiafont {
        font-family: Georgia, serif;
    }

    .timesfont {
        font-family: 'Times New Roman', serif;
    }
</style>



@section('footerSection')
@show
