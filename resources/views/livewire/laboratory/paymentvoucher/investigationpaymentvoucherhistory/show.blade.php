<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel">PAYMENT DETAILS</h5> : {{ $showdata->uniqid }} </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-dark p-2 shadow-sm border border-2 border-secondary rounded">
                        <div class="row col-md-6 p-1">
                            <label class="fw-bolder col-5 ">PAYMENT ID </label>
                            <label class="fst-normal text-break col-7"><b> : </b>
                                @if ($showdata->hms_uniqid)
                                    {{ $showdata->hms_uniqid }}
                                @elseif($showdata->pharm_uniqid)
                                    {{ $showdata->pharm_uniqid }}
                                @elseif($showdata->lab_uniqid)
                                    {{ $showdata->lab_uniqid }}
                                @elseif($showdata->scan_uniqid)
                                    {{ $showdata->scan_uniqid }}
                                @elseif($showdata->xray_uniqid)
                                    {{ $showdata->xray_uniqid }}
                                @endif
                            </label>
                        </div>
                        <div class="row col-md-6 p-1">
                            <label class="fw-bolder col-5 ">NAME </label>
                            <label class="fst-normal text-break  col-7"><b> : </b>
                                @if ($showdata->payment_to == 1 || $showdata->payment_to == 2)
                                    {{ $showdata->paymentable->name }} (
                                    {{ $showdata->paymentable->uhid ?? $showdata->paymentable->uniqid }}
                                    )
                                @elseif($showdata->payment_to == 3)
                                    {{ $showdata->paymentable->company_name }} (
                                    {{ $showdata->paymentable->uniqid }}
                                    )
                                @else
                                    {{ $showdata->others_name }}
                                @endif
                            </label>
                        </div>
                        <div class="row col-md-6 p-1">
                            <label class="fw-bolder col-5 ">USER ID </label>
                            <label class="fst-normal text-break  col-7"><b> : </b>
                                @if ($showdata->payment_to == 4)
                                    -
                                @else
                                    {{ $showdata->paymentable->uhid ?? $showdata->paymentable->uniqid }}
                                @endif
                            </label>
                        </div>

                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAYMENT TYPE',
                            'value' => $showdata->receipt_type
                                ? collect(config('archive.receipt_type'))->where('id', $showdata->receipt_type)->first()['subtype']
                                : '-',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'AMOUNT',
                            'value' => $showdata->paid_amount,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAYMENT MODE',
                            'value' => config('archive.modeofpayment')[$showdata->modeofpayment],
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAYMENT REF ID',
                            'value' => $showdata->payment_ref_id,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'BANK NAME',
                            'value' => $showdata->bank_name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAYMENT DATE',
                            'value' => $showdata->payment_date,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAYMENTED BY',
                            'value' => $showdata->creatable->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAYMENTED AT',
                            'value' => $showdata->created_at->format('d-m-Y h:i A'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                    </div>

                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        @endif
    </div>
</div>
