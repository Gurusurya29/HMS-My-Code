<div class="bg-white p-2 shadow-sm">
    <div class="row g-3 p-3">
        @include('helper.formhelper.form', [
            'type' => 'select',
            'fieldname' => 'expense_type',
            'labelname' => 'DIRECT / INDIRECT',
            'labelidname' => 'directindirectid',
            'required' => true,
            'col' => 'col-md-4',
            'default_option' => 'Select Direct / Indirect',
            'option' => config('pharmacyarchive.expense_type'),
        ])
        @include('helper.formhelper.form', [
            'type' => 'text',
            'fieldname' => 'party_name',
            'labelname' => 'PARTY NAME',
            'labelidname' => 'party_name',
            'required' => true,
            'col' => 'col-md-4',
        ])
        @include('helper.formhelper.form', [
            'type' => 'text',
            'fieldname' => 'payment_date',
            'labelname' => 'Date',
            'labelidname' => 'payment_date',
            'required' => true,
            'readonly' => true,
            'col' => 'col-md-4',
        ])
        @include('helper.formhelper.form', [
            'type' => 'text',
            'fieldname' => 'expense_value',
            'labelname' => 'EXPENSE VALUE',
            'labelidname' => 'expense_value',
            'required' => true,
            'col' => 'col-md-4',
        ])
        @include('helper.formhelper.form', [
            'type' => 'number',
            'fieldname' => 'mobile_number',
            'labelname' => 'MOBILE NUMBER',
            'labelidname' => 'mobile_number',
            'required' => true,
            'col' => 'col-md-4',
        ])
        @include('helper.formhelper.form', [
            'type' => 'select',
            'fieldname' => 'payment_towards',
            'labelname' => 'PAYMENT TOWARDS',
            'labelidname' => 'payment_towards',
            'required' => true,
            'col' => 'col-md-4',
            'default_option' => 'Select Payment Towards',
            'option' => config('pharmacyarchive.payment_towards'),
        ])
        @include('helper.formhelper.form', [
            'type' => 'textarea',
            'fieldname' => 'referance_notes',
            'labelname' => 'REFERENCE NOTES',
            'labelidname' => 'referance_notes',
            'required' => false,
            'col' => 'col-md-4',
        ])
        @include('helper.formhelper.form', [
            'type' => 'select',
            'fieldname' => 'payment_mode',
            'labelname' => 'PAYMENT MODE',
            'labelidname' => 'payment_mode',
            'required' => true,
            'col' => 'col-md-4',
            'default_option' => 'Select a Payment Mode',
            'option' => config('pharmacyarchive.payment_mode'),
        ])
        @if ($payment_mode == 3 || $payment_mode == 4 || $payment_mode == 6)
            <div class="col-md-4">
                <label for="paymentrefid" class="form-label">
                    @if ($payment_mode == 3)
                        CHEQUE NO
                    @elseif($payment_mode == 6)
                        DD NO
                    @else
                        PAYMENT REF ID
                    @endif
                </label>
                <input wire:model.lazy="payment_ref_id" type="text" class="form-control" id="paymentrefid">
                @error('payment_ref_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @include('helper.formhelper.form', [
                'type' => 'text',
                'fieldname' => 'bank_name',
                'labelname' => 'BANK NAME',
                'labelidname' => 'banknameid',
                'required' => false,
                'col' => 'col-md-4',
            ])
            @include('helper.formhelper.form', [
                'type' => 'date',
                'fieldname' => 'payment_date1',
                'labelname' => 'PAYMENT DATE',
                'labelidname' => 'paymentdate1id',
                'required' => false,
                'col' => 'col-md-4',
            ])
        @elseif ($payment_mode == 5)
            @include('helper.formhelper.form', [
                'type' => 'text',
                'fieldname' => 'reference',
                'labelname' => 'REFERENCE',
                'labelidname' => 'referenceid',
                'required' => false,
                'col' => 'col-md-4',
            ])
        @endif
    </div>
    <div class="text-center d-flex justify-content-center gap-2 align-items-center">
        <div wire:loading wire:target="store" class="mt-2">
            <div class="spinner-border loadingspinner" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <button type="submit" wire:click="store" class="btn theme_bg_color">Save</button>
        <button type="button" class="btn btn-secondary" wire:click="formreset">Cancel</button>
    </div>
</div>
