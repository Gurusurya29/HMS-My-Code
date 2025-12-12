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
                    'col' => 'col-md-3',
                ])
                @if ($payment_to == 1 || $payment_to == 2 || $payment_to == 3)
                    <div class="col-md-3" wire:ignore:self>
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
                        'col' => 'col-md-3',
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
                        'col' => 'col-md-3',
                    ])
                    @if ($payment_to == 1 || $payment_to == 3)
                        <div class="col-md-3 mb-3">
                            <label for="payment_typeid" class="form-label">PAYMENT TYPE</label>
                            <span class="text-danger fw-bold">*</span>
                            <select class="form-select" wire:model.lazy="payment_type">
                                <option value>Select Payment Type</option>
                                @foreach ($payment_type_data as $key => $value)
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
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'select',
                        'fieldname' => 'modeofpayment',
                        'labelname' => 'PAYMENT MODE',
                        'labelidname' => 'modeofpaymentid',
                        'default_option' => 'Select Mode',
                        'option' => $modeofpaymentdata,
                        'required' => true,
                        'col' => 'col-md-3',
                    ])

                    @if ($modeofpayment != 1 && $modeofpayment != null)
                        <div class="col-md-3">
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
                                'col' => 'col-md-3',
                            ])
                        @endif
                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'payment_date',
                            'labelname' => 'PAYMENT DATE',
                            'labelidname' => 'paymentdateid',
                            'required' => false,
                            'col' => 'col-md-3',
                        ])
                    @endif
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'note',
                        'labelname' => 'NOTE',
                        'labelidname' => 'noteid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                @endif
            </div>
            <div class="text-center mt-4">
                <a href="" class="btn btn-secondary">Cancel</a>
                <div wire:loading wire:target="store">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
                <button wire:loading.remove type="submit" id="submit" wire:target="store"
                    class="btn btn-primary">Save</button>
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
@endpush
