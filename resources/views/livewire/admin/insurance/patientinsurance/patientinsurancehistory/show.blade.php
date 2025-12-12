<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel">INSURANCE DETAILS : {{ $showdata->uniqid }} </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion accordion-flush mb-3" id="accordionpatientdetails">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-secondary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#patientregistrationdetails" aria-expanded="false"
                                    aria-controls="patientregistrationdetails">
                                    Patient Details
                                </button>
                            </h2>
                            <div id="patientregistrationdetails" class="accordion-collapse collapse"
                                aria-labelledby="headingOne" data-bs-parent="#accordionpatientdetails">
                                <div class="accordion-body">
                                    @include('livewire.admin.insurance.patientinsurance.common.patientregistrationdetails',
                                        [
                                            'patientinsurance' => $showdata,
                                        ])
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button
                                    class="accordion-button collapsed  bg-white shadow-sm border border-2 border-secondary rounded fs-5 p-2"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#insurancedetails"
                                    aria-expanded="true" aria-controls="insurancedetails">
                                    Insurance Details
                                </button>
                            </h2>
                            <div id="insurancedetails" class="accordion-collapse collapse show"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionpatientdetails">
                                <div class="accordion-body">
                                    <div class="row text-dark p-2 shadow-sm border border-2 border-primary rounded">
                                        <div class="fs-5 fw-bold p-0 mb-3"><span
                                                class="border-2 border-bottom border-dark">Principal
                                                Approval Request</span> :
                                        </div>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SENT BY',
                                            'value' => $showdata->pa_sentby,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SENT DATE & TIME',
                                            'value' => $showdata->pa_sentdatetime
                                                ? date('d-m-Y H:i A', strtotime($showdata->pa_sentdatetime))
                                                : '-',
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SENT MAIL ID',
                                            'value' => $showdata->pa_sentmailid,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])

                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'ESTIMATED BILL AMOUNT',
                                            'value' => $showdata->pa_estimatedamount,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'INS CONTACT PERSON NAME',
                                            'value' => $showdata->ins_contactname,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'INS CONTACT PERSON PHONE',
                                            'value' => $showdata->ins_contactphone,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'NOTE (Principal Approval Request)',
                                            'value' => $showdata->pa_sentnote,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        <hr>
                                        <div class="fs-5 fw-bold p-0 mb-3"><span
                                                class="border-2 border-bottom border-dark">Reply From Insurance Company
                                                For Principal Approval</span> :
                                        </div>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'APPROVAL STATUS',
                                            'value' => config('archive.approval_status')[
                                                $showdata->pa_approvalstatus
                                            ],
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'APPROVED AMOUNT',
                                            'value' => $showdata->pa_approvedamount,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'APPROVED AMOUNT',
                                            'value' => $showdata->pa_approvedamount,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'APPROVAL RECEIVED FROM MAIL',
                                            'value' => $showdata->pa_rec_mailid,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'APPROVAL RECEIVED FROM NAME',
                                            'value' => $showdata->pa_rec_name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        <hr>
                                        <div class="fs-5 fw-bold p-0 mb-3"><span
                                                class="border-2 border-bottom border-dark">Discharge Approval Sent To
                                                Insurance Company</span> :
                                        </div>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'FINAL BILL AMOUNT',
                                            'value' => $showdata->da_finalbillamount,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'STATUS OF TREATMENT',
                                            'value' => $showdata->da_treatmentstatus,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'SENT BY',
                                            'value' => $showdata->da_sentby,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'PROPOSED DISCHARGE DATE & TIME',
                                            'value' => $showdata->proposeddischarge_datetime,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'NOTE (Discharge Approval Request)',
                                            'value' => $showdata->da_sentnote,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        <hr>
                                        <div class="fs-5 fw-bold p-0 mb-3"><span
                                                class="border-2 border-bottom border-dark">Reply From Insurance Company
                                                For Discharge Approval</span> :
                                        </div>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'APPROVAL STATUS',
                                            'value' => config('archive.approval_status')[
                                                $showdata->da_approvalstatus
                                            ],
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'APPROVED AMOUNT',
                                            'value' => $showdata->da_approvedamount,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        <hr>
                                        <div class="fs-5 fw-bold p-0 mb-3"><span
                                                class="border-2 border-bottom border-dark">Final Bill Submitted
                                                Details</span> :
                                        </div>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'ACTUAL DISCHARGE DATE & TIME',
                                            'value' => date(
                                                'd-m-Y H:i A',
                                                strtotime($showdata->actualdischarge_datetime)
                                            ),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'ACTUAL BILL SUBMITTED ON',
                                            'value' => date(
                                                'd-m-Y H:i A',
                                                strtotime($showdata->actualbill_datetime)
                                            ),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'LIST OF DOCUMENT SUBMITTED',
                                            'value' => $showdata->doc_listsumbitted,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        <hr>
                                        <div class="fs-5 fw-bold p-0 mb-3"><span
                                                class="border-2 border-bottom border-dark">Payment Received From
                                                Insurance Company</span> :
                                        </div>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'AMOUNT',
                                            'value' => $showdata->received_amount,
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
                                        @if ($showdata->payment_ref_id)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'PAYMENT REF ID',
                                                'value' => $showdata->payment_ref_id,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                        @endif
                                        @if ($showdata->bank_name)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'BANK NAME',
                                                'value' => $showdata->bank_name,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                        @endif
                                        @if ($showdata->payment_date)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'PAYMENT DATE',
                                                'value' => $showdata->payment_date,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                        @endif
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'PAYMENT NOTE',
                                            'value' => $showdata->payment_note,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'HOSPITAL RECEIPT NUMBER',
                                            'value' => $showdata->hospital_receiptnumb,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        <hr>
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CREATED BY',
                                            'value' => $showdata->creatable->name,
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @include('helper.formhelper.showlabel', [
                                            'name' => 'CREATED AT',
                                            'value' => $showdata->created_at->format('d-m-Y h:i A'),
                                            'columnone' => 'col-md-6',
                                            'columntwo' => 'col-5',
                                            'columnthree' => 'col-7',
                                        ])
                                        @if ($showdata->updatable_id)
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'UPDATED BY',
                                                'value' => $showdata->updatable->name,
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                            @include('helper.formhelper.showlabel', [
                                                'name' => 'UPDATED AT',
                                                'value' => $showdata->updated_at->format('d-m-Y h:i A'),
                                                'columnone' => 'col-md-6',
                                                'columntwo' => 'col-5',
                                                'columnthree' => 'col-7',
                                            ])
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        @endif
    </div>
</div>
