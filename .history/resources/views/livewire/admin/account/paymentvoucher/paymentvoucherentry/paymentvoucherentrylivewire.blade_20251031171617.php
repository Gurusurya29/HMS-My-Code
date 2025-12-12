<div class="card p-0 mt-4">

    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5"> PAYMENT VOUCHER ENTRY</span></div>

        </div>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" autocomplete="off">
            <div class="row g-3">

                @include('helper.formhelper.form', [
                'type' => 'select',
                'fieldname' => 'payment_to',
                'labelname' => 'PAYMENT TO',
                'labelidname' => 'payment_toid',
                'default_option' => '',
                'option' => config('archive.payment_to'),
                'required' => true,
                'col' => 'col-md-4',
                ])
                @if ($payment_to == 1 || $payment_to == 2 || $payment_to == 3)
                <div class="col-md-4" wire:ignore>
                    <label for="selecteduser_id" class="form-label">
                        SELECT
                        @if ($payment_to == 1)
                        PATIENT
                        @elseif($payment_to == 2)
                        EMPLOYEE
                        @elseif($payment_to == 3)
                        SUPPLIER
                        @endif
                    </label>
                    <span class="text-danger fw-bold">*</span>

                    <select class="form-select" id="select2-dropdown">
                        <option value="">Select</option>
                        @foreach ($paymentuserlist as $eachpaymentuser)
                        <option value="{{ $eachpaymentuser->id }}"
                            {{ $eachpaymentuser->id == $selecteduser_id ? 'selected' : '' }}>
                            {{ $payment_to == 3 ? $eachpaymentuser->company_name : $eachpaymentuser->name }}
                            (ID: {{ $eachpaymentuser->uniqid }}, Ph: {{ $eachpaymentuser->phone }})
                        </option>
                        @endforeach
                    </select>

                    @error('selecteduser_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endif
            </div>
            <div class="text-center mt-4">
                <a href="" class="btn btn-secondary">Cancel</a>
                @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                'method_name' => 'store',
                'model_id' => '',
                ])
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:navigated', initSelect2);
    document.addEventListener('livewire:initialized', initSelect2);

    function initSelect2() {
        const $select = $('#select2-dropdown');

        // Destroy if reinitialized
        if ($select.hasClass('select2-hidden-accessible')) {
            $select.select2('destroy');
        }

        // Initialize Select2
        $select.select2();

        // Sync to Livewire property when value changes
        $select.on('change', function(e) {
            Livewire.find('{{ $this->getId() }}').set('selecteduser_id', $(this).val());
        });

        // Rehydrate when Livewire re-renders component
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            if (el.querySelector('#select2-dropdown')) {
                initSelect2();
            }
        });
    }
</script>
<!-- <script>
        $(function() {
            window.loadpaymentuserSelect2 = () => {
                $('#select2-dropdown').select2().on('change', function() {
                    let data = $(this).val();
                    @this.set('selecteduser_id', data);
                });
            }
            loadpaymentuserSelect2();
            window.livewire.on('loadpaymentSelect2Hydrate', () => {
                loadpaymentuserSelect2();
            });
        });
    </script> -->
@endpush