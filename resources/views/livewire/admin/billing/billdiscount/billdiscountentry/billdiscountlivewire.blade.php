<div class="row justify-content-center">
    <div class="my-2 col-md-8">
        <div class="dropdown">
            <label class="form-label fs-5" for="searchquery">Search Patient :</label>
            <input type="text" class="form-control shadow-sm bg-white" placeholder="Search Patient..."
                wire:model="searchquery"  wire:model.live.debounce.300ms="searchquery"/>

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
            <a href="{{ route('billdiscount') }}" class="btn btn-secondary">Clear</a>
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
                    </tr>
                </thead>
                <tbody>
                    <tr class="fs-6">
                        <td>{{ $patient->uhid }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->dob ? date('d-m-Y', strtotime($patient->dob)) : '-' }}</td>
                        <td>{{ $patient->aadharid ?? '-' }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="card p-0">
            <div class="card-header text-white theme_bg_color">
                Bill Discount/Cancel
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store" autocomplete="off">
                    <div class="row g-3">
                        @include('helper.formhelper.form', [
                            'type' => 'select',
                            'fieldname' => 'discount_type',
                            'labelname' => 'DISCOUNT/CANCEL',
                            'labelidname' => 'discount_typeid',
                            'default_option' => 'Select Type',
                            'option' => config('archive.discount_type'),
                            'required' => true,
                            'col' => 'col-md-4',
                        ])

                        <div class="col-md-4 mb-3">
                            <label for="bill_typeid" class="form-label">BILL TYPE</label>
                            <span class="text-danger fw-bold">*</span>
                            <select class="form-select" wire:model.lazy="bill_type">
                                <option value>Select Bill Type</option>
                                @foreach ($billtype_data as $key => $value)
                                    <option value="{{ $value['id'] }}">{{ $value['subtype'] }}</option>
                                @endforeach
                            </select>
                            @error('bill_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($bill_type)
                            <div class="col-md-4 mb-3 dropdown">
                                <label for="selectbill_id" class="form-label">SELECT BILL</label>
                                <span class="text-danger fw-bold">*</span>
                                <input wire:model.debounce.150ms="select_bill" wire:keyup="searchbill"
                                    wire:focus="searchbillfoucs" id="select_bill" class="form-control"
                                    autocomplete="off" type="text" placeholder="Search Bill..">

                                @error('select_bill')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                                @if (!empty($select_bill) && !empty($searchbilllist))
                                    <ul class="dropdown-menu list-group w-100 p-0">
                                        @if (!empty($searchbilllist))
                                            @foreach ($searchbilllist as $i => $eachsearchbilllist)
                                                <li wire:click="selectedbill('{{ $eachsearchbilllist->id }}')"
                                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                    <span>{{ $eachsearchbilllist->uniqid }}</span>
                                                    <span>Rs.{{ $eachsearchbilllist->grand_total ?? '0' }} </span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        @endif

                        @if ($this->discount_type == 1)
                            @include('helper.formhelper.form', [
                                'type' => 'number',
                                'fieldname' => 'discount_amount',
                                'labelname' => 'AMOUNT',
                                'labelidname' => 'discount_amountid',
                                'required' => true,
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
