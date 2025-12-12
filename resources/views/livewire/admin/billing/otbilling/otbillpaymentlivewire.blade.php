<div class="card">
    @if ($otbillingdata)
        <div class="card-header text-white theme_bg_color d-flex d-flex justify-content-between">
            <div class="h5 mb-0">
                OT BILL | #{{ $otbillingdata->patient->uhid }}</div>
            <div class="h5 mb-0">
                <span class="text-warning fw-bold">NAME :</span> {{ $otbillingdata->patient->name }}
                |
                <span class="text-warning fw-bold">AGE :</span> {{ $otbillingdata->patient->age ?? '-' }}|
                <span class="text-warning fw-bold">GENDER :</span>
                {{ $otbillingdata->patient->gender ? Config::get('archive.gender')[$otbillingdata->patient->gender] : '-' }}|

                <span class="text-warning fw-bold">PHONE :</span>
                {{ $otbillingdata->patient->phone }}
            </div>
        </div>

        <div class="card-body p-0 m-0">
            <div class="table-responsive px-5 mt-1">
                <table class="table table-bordered shadow-sm table-success text-center">
                    <thead class="fw-bold " style="font-size: 16px;">
                        <tr>
                            <th scope="col">Visit ID</th>
                            <th scope="col">IP Billing ID</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                            <th scope="col">Bill Disc/Cancel</th>
                            <th scope="col">Net Value</th>
                            <th scope="col">Patient Excess Paid</th>
                            <th scope="col">Patient to Pay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fs-5">
                            <td>{{ $otbillingdata->patientvisit->uniqid }}</td>
                            <td>{{ $otbillingdata->uniqid }}</td>
                            <td>{{ $otbillingdata->sub_total }}</td>
                            <td>{{ $otbillingdata->discount }}</td>
                            <td>{{ $otbillingdata->total }}</td>
                            <td>{{ $otbillingdata->billdiscount_amount }}</td>
                            <td>{{ $otbillingdata->grand_total }}</td>
                            <td>{{ $balance < 0 ? abs($balance) : 0 }}</td>
                            <td>{{ $balance > 0 ? $balance : 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card m-4">
                <div class="card-header text-white theme_bg_color d-flex justify-content-between">
                    <div>
                        Bill Payment
                    </div>
                    <div>
                        @can('Otbill')
                            <a href="{{ route('otbillingservice', $otbillingdata->uuid) }}"
                                class="btn btn-sm btn-primary">Billing Screen</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="storebillpayment" autocomplete="off">

                        <div class="row g-3">
                            @include('helper.formhelper.form', [
                                'type' => 'select',
                                'fieldname' => 'payment_type',
                                'labelname' => 'PAYMENT TYPE',
                                'labelidname' => 'paymenttypeid',
                                'default_option' => 'Select Type',
                                'option' => config('archive.payment_type'),
                                'required' => true,
                                'col' => 'col-md-4',
                            ])
                            @include('helper.formhelper.form', [
                                'type' => 'number',
                                'fieldname' => 'received_amount',
                                'labelname' => 'AMOUNT',
                                'labelidname' => 'receivedamountid',
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
                        </div>
                        <div class="text-center mt-4">
                            <a href="" class="btn btn-secondary">Cancel</a>
                            @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                                'method_name' => 'storebillpayment',
                                'model_id' => '',
                            ])
                        </div>
                    </form>
                </div>
            </div>
            <div class="card m-4">
                <div class="card-header text-white theme_bg_color">Bill Payment Lists</div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped p-0 m-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Receipt ID</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Payment Mode</th>
                                    <th scope="col">Ref. ID</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Print Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($otreceiptdata)
                                    @if ($otreceiptdata->isNotEmpty())
                                        @foreach ($otreceiptdata as $key => $eachreceiptdata)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $eachreceiptdata->hms_uniqid }}</td>
                                                <td>{{ config('archive.payment_type')[$eachreceiptdata->payment_type] }}
                                                </td>
                                                <td>{{ $eachreceiptdata->received_amount }}</td>
                                                @if ($eachreceiptdata->payment_type == 1)
                                                    <td>{{ config('archive.modeofpayment')[$eachreceiptdata->modeofpayment] }}
                                                    </td>
                                                @else
                                                    <td>{{ config('archive.modeofpayment')[$eachreceiptdata->modeofpayment] }}
                                                    </td>
                                                @endif
                                                <td>{{ $eachreceiptdata->payment_ref_id ?? '-' }}</td>
                                                <td>{{ $eachreceiptdata->note ?? '-' }}</td>
                                                <td>
                                                    <button wire:click="printotreceiptlist({{ $eachreceiptdata->id }})"
                                                        class="btn btn-sm btn-success"><i
                                                            class="bi bi-printer"></i></button>
                                                    {{-- <button
                                                        wire:click="downloadotpaymentreceipt({{ $eachreceiptdata->id }})"
                                                        class="btn btn-sm btn-warning"><i
                                                            class="bi bi-file-earmark-pdf"></i></button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No Record Found</td>
                                        </tr>
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
