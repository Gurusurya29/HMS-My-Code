<div class="card p-0 mt-4">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1">
                <span class="h5">PAYMENT VOUCHER ENTRY</span>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form wire:submit.prevent="store" autocomplete="off">
            <div class="row g-3">

                {{-- PAYMENT TO --}}
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

                {{-- CONDITIONAL USER SELECT --}}
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
                @elseif($payment_to == 4)
                @include('helper.formhelper.form', [
                'type' => 'text',
                'fieldname' => 'others_name',
                'labelname' => 'OTHERS NAME',
                'labelidname' => 'others_nameid',
                'required' => true,
                'col' => 'col-md-4',
                ])
                @endif

                {{-- REST OF YOUR EXISTING FORM --}}
                @if ($payment_to)
                @include('helper.formhelper.form', [
                'type' => 'select',
                'fieldname' => 'payment_reason',
                'labelname' => 'PAYMENT REASON',
                'labelidname' => 'payment_reasonid',
                'default_option' => 'Select Reason',
                'option' => config('archive.payment_reason'),
                'required' => true,
                'col' => 'col-md-4',
                ])

                @if ($payment_to == 1 || $payment_to == 3)
                <div class="col-md-4 mb-3">
                    <label for="payment_typeid" class="form-label">PAYMENT TYPE</label>
                    <span class="text-danger fw-bold">*</span>
                    <select class="form-select" wire:model.lazy="payment_type">
                        <option value="">Select Payment Type</option>
                        @foreach ($payment_typedata as $key => $value)
                        <option value="{{ $value['id'] }}">{{ $value['subtype'] }}</option>
                        @endforeach
                    </select>
                    @error('payment_type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endif

                @include('helper.formhelper.form', [
                'type' => 'number',
                'fieldname' => 'paid_amount',
                'labelname' => 'AMOUNT',
                'labelidname' => 'paid_amountid',
                'required' => true,
                'col' => 'col-md-4',
                ])

                @include('helper.formhelper.form', [
                'type' => 'select',
                'fieldname' => 'modeofpayment',
                'labelname' => 'PAYMENT MODE',
                'labelidname' => 'modeofpaymentid',
                'default_option' => 'Select Mode',
                'option' => $modeofpaymentdata,
                'required' => true,
                'col' => 'col-md-4',
                ])

                {{-- Additional Payment Fields --}}
                @if ($modeofpayment != 1 && $modeofpayment != null)
                <div class="col-md-4">
                    <label for="paymentrefid" class="form-label">
                        @if ($modeofpayment == 4)
                        CHEQUE NO
                        @elseif($modeofpayment == 5)
                        DD NO
                        @else
                        PAYMENT REF ID
                        @endif
                    </label>
                    <input wire:model.lazy="payment_ref_id" type="text" class="form-control"
                        id="paymentrefid">
                    @error('payment_ref_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @if ($modeofpayment != 6)
                @include('helper.formhelper.form', [
                'type' => 'text',
                'fieldname' => 'bank_name',
                'labelname' => 'BANK NAME',
                'labelidname' => 'banknameid',
                'required' => false,
                'col' => 'col-md-4',
                ])
                @endif

                @include('helper.formhelper.form', [
                'type' => 'date',
                'fieldname' => 'payment_date',
                'labelname' => 'PAYMENT DATE',
                'labelidname' => 'paymentdateid',
                'required' => false,
                'col' => 'col-md-4',
                ])
                @endif

                @include('helper.formhelper.form', [
                'type' => 'textarea',
                'fieldname' => 'note',
                'labelname' => 'NOTE',
                'labelidname' => 'noteid',
                'required' => false,
                'col' => 'col-md-4',
                ])
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
    document.addEventListener('livewire:initialized', () => {
        initSelect2();
    });

    document.addEventListener('livewire:navigated', () => {
        initSelect2();
    });

    // Livewire 3 - re-run when DOM updates
    Livewire.hook('morph.updated', ({
        el,
        component
    }) => {
        if (el.querySelector('#select2-dropdown')) {
            initSelect2();
        }
    });

    function initSelect2() {
        const $select = $('#select2-dropdown');

        if ($select.length) {
            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }

            $select.select2();

            $select.off('change').on('change', function() {
                const selectedValue = $(this).val();
                const component = Livewire.find($select.closest('[wire\\:id]').attr('wire:id'));
                component.set('selecteduser_id', selectedValue);
            });
        }
    }
</script>
@endpush

<!-- <div class="card p-0 mt-4">

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
                <div class="col-md-4" wire:ignore:self>
                    <label for="selecteduser_id" class="form-label">SELECT
                        @if ($payment_to == 1)
                        PATIENT
                        @elseif($payment_to == 2)
                        EMPLOYEE
                        @elseif($payment_to == 3)
                        SUPPLIER
                        @endif
                    </label>
                    <span class="text-danger fw-bold">*</span>
                    <select wire:model.lazy="selecteduser_id" class="form-select" id="select2-dropdown">
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
                @elseif($payment_to == 4)
                @include('helper.formhelper.form', [
                'type' => 'text',
                'fieldname' => 'others_name',
                'labelname' => 'OTHERS NAME',
                'labelidname' => 'others_nameid',
                'required' => true,
                'col' => 'col-md-4',
                ])
                @endif
                @if ($payment_to)
                @include('helper.formhelper.form', [
                'type' => 'select',
                'fieldname' => 'payment_reason',
                'labelname' => 'PAYMENT REASON',
                'labelidname' => 'payment_reasonid',
                'default_option' => 'Select Reason',
                'option' => config('archive.payment_reason'),
                'required' => true,
                'col' => 'col-md-4',
                ])
                @if ($payment_to == 1 || $payment_to == 3)
                <div class="col-md-4 mb-3">
                    <label for="payment_typeid" class="form-label">PAYMENT TYPE</label>
                    <span class="text-danger fw-bold">*</span>
                    <select class="form-select" wire:model.lazy="payment_type">
                        <option value>Select Payment Type</option>
                        @foreach ($payment_typedata as $key => $value)
                        <option value="{{ $value['id'] }}">{{ $value['subtype'] }}</option>
                        @endforeach
                    </select>
                    @error('payment_type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endif
                @include('helper.formhelper.form', [
                'type' => 'number',
                'fieldname' => 'paid_amount',
                'labelname' => 'AMOUNT',
                'labelidname' => 'paid_amountid',
                'required' => true,
                'col' => 'col-md-4',
                ])
                @include('helper.formhelper.form', [
                'type' => 'select',
                'fieldname' => 'modeofpayment',
                'labelname' => 'PAYMENT MODE',
                'labelidname' => 'modeofpaymentid',
                'default_option' => 'Select Mode',
                'option' => $modeofpaymentdata,
                'required' => true,
                'col' => 'col-md-4',
                ])

                @if ($modeofpayment != 1 && $modeofpayment != null)
                <div class="col-md-4">
                    <label for="paymentrefid" class="form-label">
                        @if ($modeofpayment == 4)
                        CHEQUE NO
                        @elseif($modeofpayment == 5)
                        DD NO
                        @else
                        PAYMENT REF ID
                        @endif
                    </label>
                    <input wire:model.lazy="payment_ref_id" type="text" class="form-control"
                        id="paymentrefid">
                    @error('payment_ref_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if ($modeofpayment != 6)
                @include('helper.formhelper.form', [
                'type' => 'text',
                'fieldname' => 'bank_name',
                'labelname' => 'BANK NAME',
                'labelidname' => 'banknameid',
                'required' => false,
                'col' => 'col-md-4',
                ])
                @endif
                @include('helper.formhelper.form', [
                'type' => 'date',
                'fieldname' => 'payment_date',
                'labelname' => 'PAYMENT DATE',
                'labelidname' => 'paymentdateid',
                'required' => false,
                'col' => 'col-md-4',
                ])
                @endif
                @include('helper.formhelper.form', [
                'type' => 'textarea',
                'fieldname' => 'note',
                'labelname' => 'NOTE',
                'labelidname' => 'noteid',
                'required' => false,
                'col' => 'col-md-4',
                ])
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
</script>
@endpush -->

