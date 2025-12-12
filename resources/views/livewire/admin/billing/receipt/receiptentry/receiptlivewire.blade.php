<div class="row justify-content-center">
    <div class="my-2 col-md-8">
        <div class="dropdown">
            <label class="form-label fs-5" for="searchquery">Search Patient :</label>
            <input type="text" class="form-control shadow-sm bg-white" placeholder="Search Patient..."
                wire:model="searchquery" wire:model.live.debounce.300ms="searchquery"/>

              <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                <li class="ist-group-item d-flex justify-content-between align-items-center">
                    Searching...</li>
            </ul>

            @if (!empty($searchquery))
                <ul class="dropdown-menu list-group w-100 p-0">
                    @if (!empty($patientlist))
                        @foreach ($patientlist as $i => $eachpatientlist)
                            <li wire:click="selectedpatient({{ $eachpatientlist['id'] }})"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                role="button">
                                <h6> {{ $eachpatientlist['name'] }} </h6>

                                <h5>
                                    <span class=" badge bg-success rounded-pill">
                                        Ph: {{ $eachpatientlist['phone'] }}</span>
                                    <span class=" badge bg-primary rounded-pill">
                                        {{ $eachpatientlist['uhid'] }}</span>
                                </h5>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            No results!
                            <span class="badge bg-primary rounded-pill">0</span>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
    @if ($patient)
        <div class="my-3 col-md-2 align-self-end">
            <a href="{{ route('receipt') }}" class="btn btn-secondary">Clear</a>
        </div>
        <div class="table-responsive px-5 mt-4">
            <table class="table table-bordered shadow-sm table-success text-center">
                <thead class="fw-bold " style="font-size: 14px;">
                    <tr>
                        <th scope="col">UHID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Aadhar</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Patient Excess Paid</th>
                        <th scope="col">Patient to Pay</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="fs-6">
                        <td>{{ $patient->uhid }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->dob ? date('d-m-Y', strtotime($patient->dob)) : '-' }}</td>
                        <td>{{ $patient->aadharid ?? '-' }}</td>
                        <td>{{ $total_amount ?? '0' }}</td>
                        <td>{{ $balance < 0 ? abs($balance) : 0 }}</td>
                        <td>{{ $balance > 0 ? $balance : 0 }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="card p-0">
            <div class="card-header text-white theme_bg_color">
                Receipt
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store" autocomplete="off">
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

                        <div class="col-md-4 mb-3">
                            <label for="receipt_typeid" class="form-label">RECEIPT TYPE</label>
                            <span class="text-danger fw-bold">*</span>
                            <select class="form-select" wire:model.lazy="receipt_type">
                                <option value>Select Receipt Type</option>
                                @foreach (config('archive.receipt_type') as $key => $value)
                                    <option value="{{ $value['id'] }}">{{ $value['subtype'] }}</option>
                                @endforeach
                            </select>
                            @error('receipt_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
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
                            'method_name' => 'store',
                            'model_id' => '',
                        ])
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
