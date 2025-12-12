<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{{ config('app.name', '8Queens') }}</title>

<script>
    document.addEventListener("livewire:initialized", () => {
        initSelect2();

        Livewire.hook('morph.updated', () => {
            initSelect2();
        });
    });

    function initSelect2() {
        $('.select2').each(function() {
            let $this = $(this);

            // Destroy existing Select2 before reinit
            if ($this.hasClass("select2-hidden-accessible")) {
                $this.select2('destroy');
            }

            $this.select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            }).on('change', function() {
                let data = $(this).val();
                let model = $(this).attr('wire:model');
                let component = $(this).closest('[wire\\:id]').attr('wire:id');
                if (model && component) {
                    Livewire.find(component).set(model, data);
                }
            });
        });
    }
</script>
