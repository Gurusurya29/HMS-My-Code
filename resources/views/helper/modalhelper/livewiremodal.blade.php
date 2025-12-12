<!-- <script type="text/javascript">
    // CREATE
    window.livewire.on('closemodal', () => {
        $('#createoreditModal').modal('hide');
    });
    // EDIT
    window.livewire.on('editmodal', () => {
        var myModal = new bootstrap.Modal(document.getElementById('createoreditModal'))
        myModal.show();
    });
    // SHOW
    window.livewire.on('showmodal', () => {
        var myModal = new bootstrap.Modal(document.getElementById('showModal'))
        myModal.show();
    });
    window.livewire.on('closeshowmodal', () => {
        $('#showModal').modal('hide');
    });
    // CLOSE RESET
    var myModal = document.getElementById('createoreditModal')
    myModal.addEventListener('hidden.bs.modal', () => window.livewire.dispatch('formreset'))
</script> -->
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {

        // Close Modal
        Livewire.on('closemodal', () => {
            let modal = bootstrap.Modal.getInstance(document.getElementById('createoreditModal'));
            if (modal) modal.hide();
        });

        // Edit - Open Modal
        Livewire.on('editmodal', () => {
            let modal = new bootstrap.Modal(document.getElementById('createoreditModal'));
            modal.show();
        });

        // Show - Open Show Modal
        Livewire.on('showmodal', () => {
            let modal = new bootstrap.Modal(document.getElementById('showModal'));
            modal.show();
        });

        // Close Show Modal
        Livewire.on('closeshowmodal', () => {
            let modal = bootstrap.Modal.getInstance(document.getElementById('showModal'));
            if (modal) modal.hide();
        });

        // Reset Form when modal is hidden
        document.getElementById('createoreditModal')
            .addEventListener('hidden.bs.modal', function() {
                Livewire.dispatch('formreset');
            });

        // Toast Example - Listen for alerts
        Livewire.on('alert', (data) => {
            Swal.fire({
                icon: data.type,
                title: data.message,
                timer: 2000,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });
        });

    });
</script>