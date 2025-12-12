<div class="card">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">INSURANCE PROCESS</span></div>
            <div class="bd-highlight d-flex gap-1">
                @if ($type == 'create')
                    <a href="{{ route('patientinsurancelist') }}" class="btn btn-sm btn-secondary">Back</a>
                @else
                    <a href="{{ route('patientinsurancehistory') }}" class="btn btn-sm btn-secondary">Back</a>
                @endif
            </div>
        </div>
    </div>

    <form wire:submit.prevent="store" autocomplete="off">
        <div class="card-body">
            <div class="accordion accordion-flush mb-3" id="accordionpatientdetails">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button
                            class="accordion-button collapsed  bg-white shadow-sm border border-2 border-secondary rounded fs-5 p-2"
                            type="button" data-bs-toggle="collapse" data-bs-target="#patientregistrationdetails"
                            aria-expanded="false" aria-controls="patientregistrationdetails">
                            Patient Details
                        </button>
                    </h2>
                    <div id="patientregistrationdetails" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionpatientdetails">
                        <div class="accordion-body">
                            @include('livewire.admin.insurance.patientinsurance.common.patientregistrationdetails')
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if ($stage >= 0)
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded my-3">Principal Approval Request
                    </div>

                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'pa_sentby',
                        'labelname' => 'SENT BY',
                        'labelidname' => 'pa_sentbyid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    <div class="col-md-3 mb-3">
                        <label for="pa_sentdatetimeid" class="form-label">SENT DATE & TIME</label>
                        <span class="text-danger fw-bold">*</span>
                        <input type="datetime-local" wire:model="pa_sentdatetime" id="pa_sentdatetimeid"
                            class="form-control">
                        @error('pa_sentdatetime')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'email',
                        'fieldname' => 'pa_sentmailid',
                        'labelname' => 'SENT MAIL ID',
                        'labelidname' => 'pa_sentmailidid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'number',
                        'fieldname' => 'pa_estimatedamount',
                        'labelname' => 'ESTIMATED BILL AMOUNT',
                        'labelidname' => 'pa_estimatedamountid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'ins_contactname',
                        'labelname' => 'INS CONTACT PERSON NAME',
                        'labelidname' => 'ins_contactnameid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'number',
                        'fieldname' => 'ins_contactphone',
                        'labelname' => 'INS CONTACT PERSON PHONE',
                        'labelidname' => 'ins_contactphoneid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'pa_sentnote',
                        'labelname' => 'NOTE (Principal Approval Request)',
                        'labelidname' => 'pa_sentnoteid',
                        'required' => true,
                        'col' => 'col-md-6',
                    ])
                @endif
                @if ($stage >= 1)
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded my-3">Reply From Insurance Company For
                        Principal Approval
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'select',
                        'default_option' => 'Select Status',
                        'fieldname' => 'pa_approvalstatus',
                        'labelname' => 'APPROVAL STATUS ',
                        'labelidname' => 'pa_approvalstatusid',
                        'required' => true,
                        'col' => 'col-md-3',
                        'option' => config('archive.approval_status'),
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'number',
                        'fieldname' => 'pa_approvedamount',
                        'labelname' => 'APPROVED AMOUNT',
                        'labelidname' => 'pa_approvedamountid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'email',
                        'fieldname' => 'pa_rec_mailid',
                        'labelname' => 'APPROVAL RECEIVED FROM MAIL',
                        'labelidname' => 'pa_rec_mailidid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'pa_rec_name',
                        'labelname' => 'APPROVAL RECEIVED FROM NAME',
                        'labelidname' => 'pa_rec_nameid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                    <div class="col-md-3 mb-3">
                        <label class="form-label">ESTIMATED BILL VALUE</label>
                        <div class="fs-5 text-success fw-bold">Rs. {{ $pa_estimatedamount }}</div>
                    </div>
                @endif
                @if ($stage >= 2)
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded my-3">Discharge Approval Sent To
                        Insurance
                        Company
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'number',
                        'fieldname' => 'da_finalbillamount',
                        'labelname' => 'FINAL BILL AMOUNT',
                        'labelidname' => 'da_finalbillamountid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'da_treatmentstatus',
                        'labelname' => 'STATUS OF TREATMENT',
                        'labelidname' => 'da_treatmentstatusid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])

                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'da_sentby',
                        'labelname' => 'SENT BY',
                        'labelidname' => 'da_sentbyid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    <div></div>
                    <div class="col-md-4 mb-3">
                        <label for="proposeddischarge_datetimeid" class="form-label">PROPOSED DISCHARGE DATE &
                            TIME</label>
                        <span class="text-danger fw-bold">*</span>
                        <input type="datetime-local" wire:model="proposeddischarge_datetime"
                            id="proposeddischarge_datetimeid" class="form-control">
                        @error('proposeddischarge_datetime')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'da_sentnote',
                        'labelname' => 'NOTE (Discharge Approval Request)',
                        'labelidname' => 'da_sentnoteid',
                        'required' => true,
                        'col' => 'col-md-5',
                    ])
                @endif
                @if ($stage >= 3)
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded my-3">Reply From Insurance Company For
                        Discharge
                        Approval
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'select',
                        'default_option' => 'Select Status',
                        'fieldname' => 'da_approvalstatus',
                        'labelname' => 'APPROVAL STATUS ',
                        'labelidname' => 'da_approvalstatusid',
                        'required' => true,
                        'col' => 'col-md-3',
                        'option' => config('archive.approval_status'),
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'number',
                        'fieldname' => 'da_approvedamount',
                        'labelname' => 'APPROVED AMOUNT',
                        'labelidname' => 'da_approvedamountid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                    <div class="col-md-3 mb-3">
                        <label class="form-label">REQUESTED FINAL BILL VALUE</label>
                        <div class="fs-5 text-success fw-bold">Rs. {{ $da_finalbillamount }}</div>
                    </div>
                @endif
                @if ($stage >= 4)
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded my-3">Final Bill Submitted Details
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="actualdischarge_datetimeid" class="form-label">ACTUAL DISCHARGE DATE &
                            TIME</label>
                        {{-- <span class="text-danger fw-bold">*</span> --}}
                        <input type="datetime-local" wire:model="actualdischarge_datetime"
                            id="actualdischarge_datetimeid" class="form-control">
                        @error('actualdischarge_datetime')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="actualbill_datetimeid" class="form-label">ACTUAL BILL SUBMITTED ON</label>
                        <input type="datetime-local" wire:model="actualbill_datetime" id="actualbill_datetimeid"
                            class="form-control">
                        @error('actualbill_datetime')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'doc_listsumbitted',
                        'labelname' => 'LIST OF DOCUMENT SUBMITTED TO INSURANCE',
                        'labelidname' => 'doc_listsumbittedid',
                        'required' => false,
                        'col' => 'col-md-5',
                    ])
                @endif
                @if ($stage >= 5)
                    <div class="theme_bg_color text-white fs-5 px-2 py-1 rounded my-3">Payment Received From Insurance
                        Company
                    </div>
                    @include('helper.formhelper.form', [
                        'type' => 'number',
                        'fieldname' => 'received_amount',
                        'labelname' => 'AMOUNT',
                        'labelidname' => 'received_amountid',
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'select',
                        'fieldname' => 'modeofpayment',
                        'labelname' => 'PAYMENT MODE',
                        'labelidname' => 'modeofpaymentid',
                        'default_option' => 'Select Mode',
                        'option' => config('archive.modeofpayment'),
                        'required' => true,
                        'col' => 'col-md-3',
                    ])
                    @if ($modeofpayment == 2 || $modeofpayment == 3 || $modeofpayment == 4 || $modeofpayment == 5)
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
                            <span class="text-danger fw-bold">*</span>
                            <input wire:model.lazy="payment_ref_id" type="text" class="form-control"
                                id="paymentrefid">
                            @error('payment_ref_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @include('helper.formhelper.form', [
                            'type' => 'text',
                            'fieldname' => 'bank_name',
                            'labelname' => 'BANK NAME',
                            'labelidname' => 'banknameid',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'date',
                            'fieldname' => 'payment_date',
                            'labelname' => 'PAYMENT DATE',
                            'labelidname' => 'paymentdateid',
                            'required' => true,
                            'col' => 'col-md-3',
                        ])
                    @endif
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'payment_note',
                        'labelname' => 'PAYMENT NOTE',
                        'labelidname' => 'payment_noteid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'hospital_receiptnumb',
                        'labelname' => 'HOSPITAL RECEIPT NUMBER',
                        'labelidname' => 'hospital_receiptnumbid',
                        'required' => false,
                        'col' => 'col-md-3',
                    ])
                @endif
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="" class="btn btn-secondary">Cancel</a>
            @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                'method_name' => 'store',
                'model_id' => '',
            ])
        </div>
    </form>
</div>
