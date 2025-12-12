<div class="card">
    @if ($opbillingdata)
        <div class="card-header text-white theme_bg_color d-flex justify-content-between">
            <div class="h5 mb-0">
                OP BILLING | #{{ $opbillingdata->patient->uhid }}</div>
            <div class="h5 mb-0">
                <span class="text-warning fw-bold">NAME :</span> {{ $opbillingdata->patient->name }}
                |
                <span class="text-warning fw-bold">AGE :</span>
                {{ $opbillingdata->patient->age ?? '-' }}|
                <span class="text-warning fw-bold">GENDER :</span>
                {{ $opbillingdata->patient->gender ? Config::get('archive.gender')[$opbillingdata->patient->gender] : '-' }}|

                <span class="text-warning fw-bold">PHONE :</span>
                {{ $opbillingdata->patient->phone }}
                <span class="mx-3">
                    <a href="{{ route('opbilling') }}" class="btn btn-sm btn-secondary">Back</a>
                </span>
            </div>
        </div>

        <div class="card-body p-0 m-0">

            <div class="table-responsive px-2 mt-1">
                <table class="table table-bordered shadow-sm table-success text-center w-100">
                    <thead class="fw-bold " style="font-size: 16px;">
                        <tr>
                            <th scope="col">Visit ID</th>
                            <th scope="col">OP Billing ID</th>
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
                            <td>{{ $opbillingdata->patientvisit->uniqid }}</td>
                            <td>{{ $opbillingdata->uniqid }}</td>
                            <td>{{ $opbillingdata->opbillinglist->sum('sub_total') }}</td>
                            <td>{{ $opbillingdata->opbillinglist->sum('discount') }}</td>
                            <td>{{ $opbillingdata->opbillinglist->sum('total') }}</td>
                            <td>{{ $opbillingdata->opbillinglist->sum('billdiscount_amount') }}</td>
                            <td>{{ $opbillingdata->opbillinglist->sum('grand_total') }}</td>
                            <td>{{ $balance < 0 ? abs($balance) : 0 }}</td>
                            <td>{{ $balance > 0 ? $balance : 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card m-4">
                <div class="row g-2 m-1">
                    <div class="col-md-6">
                        <div class="">
                            <a href="{{ route('opservicemaster') }}" target="_blank"
                                class="btn btn-sm btn-success shadow">Add New
                                OP Billing
                                Service</a>
                        </div>
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="mx-auto">
                                    <div class="dropdown">
                                        <!-- <input type="text" class="form-control shadow-sm" 
                                            placeholder="Search Services..." wire:model.debounce.150ms="searchquery" /> -->

                                        <input wire:model="searchquery" type="text" wire:model.live.debounce.300ms="searchquery" class="form-control shadow-sm" placeholder="Search Services...">

                                        <ul wire:loading class="dropdown-menu list-group w-100" style="display: {{ $searchquery ? 'block' : 'none' }}">
                                            <li
                                                class="ist-group-item d-flex justify-content-between align-items-center">
                                                Searching...</li>
                                        </ul>

                                        @if (!empty($searchquery))
                                            <ul class="dropdown-menu list-group w-100 p-0 bg-gray shadow-sm">
                                                @if (!empty($opservicemasterlist))
                                                    @foreach ($opservicemasterlist as $i => $eachopservicemasterlist)
                                                        <li wire:click="additem({{ $eachopservicemasterlist['id'] }})"
                                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                            <h6> {{ $eachopservicemasterlist['name'] }} </h6>

                                                            <h5>
                                                                <span class=" badge bg-primary rounded-pill">Fee:
                                                                    {{ $opbillingdata->patientvisit->billing_type == 1 ? $eachopservicemasterlist['selffee'] : $eachopservicemasterlist['insurancefee'] }}</span>
                                                            </h5>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        No results!
                                                        <span class="badge bg-primary rounded-pill">0</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-1 text-end">
                            <button wire:click="additem()" type="button" class="btn btn-sm btn-success shadow">Add
                                Temporary
                                Service</button>
                            @can('Oppaybill')
                                <a href="{{ route('opbillpayment', $opbillingdata->uuid) }}"
                                    class="btn btn-sm btn-primary">Receipt Screen</a>
                            @endcan
                        </div>
                        <div class="card rounded-2">
                            <form wire:submit.prevent="storeservice()" autocomplete="off"
                                onkeydown="return event.key != 'Enter';">
                                <div class="table-responsive">
                                    <table class="table text-center p-0 m-0 w-100">
                                        <thead class="text-white theme_bg_color">
                                            <tr>
                                                <th scope="col">Description</th>
                                                <th scope="col" style="width:20%;">Fee</th>
                                                <th scope="col" style="width:10%;">Quantity</th>
                                                <th scope="col">Amount</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($selectedopservicemasterlist)
                                                @foreach ($selectedopservicemasterlist as $key => $eachselectedopservicemasterlist)
                                                    <tr>
                                                        <td>
                                                            @if ($eachselectedopservicemasterlist['opservicemaster_id'])
                                                                {{ $eachselectedopservicemasterlist['opservice_name'] }}
                                                            @else
                                                                <input
                                                                    wire:model.debounce.150ms="selectedopservicemasterlist.{{ $key }}.opservice_name"
                                                                    type="text" class="form-control"
                                                                    placeholder="Description">
                                                                @error('selectedopservicemasterlist.' . $key .
                                                                    '.opservice_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($eachselectedopservicemasterlist['opservicemaster_id'])
                                                                {{ $eachselectedopservicemasterlist['opservice_fee'] }}
                                                            @else
                                                                <input
                                                                    wire:model.debounce.150ms="selectedopservicemasterlist.{{ $key }}.opservice_fee"
                                                                    type="number" class="form-control"
                                                                    placeholder="Fee"
                                                                    wire:keyup="billingservicecalc({{ $key }})"
                                                                    wire:change="billingservicecalc({{ $key }})">
                                                                @error('selectedopservicemasterlist.' . $key .
                                                                    '.opservice_fee')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input
                                                                wire:model.debounce.150ms="selectedopservicemasterlist.{{ $key }}.quantity"
                                                                type="number" class="form-control" placeholder="Qty"
                                                                wire:keyup="billingservicecalc({{ $key }})"
                                                                wire:change="billingservicecalc({{ $key }})">
                                                            @error('selectedopservicemasterlist.' . $key . '.quantity')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td class="fw-bold fs-5">
                                                            Rs.{{ $selectedopservicemasterlist[$key]['final_amount'] }}
                                                        </td>
                                                        <td class="text-center">
                                                            <button
                                                                wire:click.prevent="removeitem({{ $key }})"
                                                                class="btn btn-danger btn-sm"><i
                                                                    class="bi bi-trash-fill"></i> </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-muted">No record found
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                @if (!empty($selectedopservicemasterlist))
                                    <div class="mt-2 row align-items-center">
                                        <div class="col-md-6">
                                            <div class="p-2">
                                                <label for="discount" class="form-label fw-bold">Discount
                                                </label>
                                                <input wire:model.debounce.<div class="mt-2 row align-items-center">
                                        <div class="col-md-6">
                                            <div class="p-2">
                                                <label for="discount" class="form-label fw-bold">Discount
                                                </label>
                                                <input wire:model.debounce.150ms="discount" id="discount"
                                                    type="number" class="form-control">
                                                @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fs-5 fw-bold text-end p-2">
                                                Total: <span class="fw-semibold">Rs.{{ $total }}</span>
                                            </div>
                                            <div class="fs-5 fw-bold text-end p-2">
                                                Grand Total: <span class="fw-semibold">Rs.{{ $grandtotal }}</span>
                                            </div>
                                        </div>
                                    </div>="discount" id="discount"
                                                    type="number" class="form-control">
                                                @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fs-5 fw-bold text-end p-2">
                                                Total: <span class="fw-semibold">Rs.{{ $total }}</span>
                                            </div>
                                            <div class="fs-5 fw-bold text-end p-2">
                                                Grand Total: <span class="fw-semibold">Rs.{{ $grandtotal }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (!empty($selectedopservicemasterlist))
                                    <div class="card-footer text-center bg-light px-2 py-1">
                                        <a href="" class="btn btn-secondary">Cancel</a>
                                        @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                                            'method_name' => 'storeservice',
                                            'model_id' => '',
                                        ])
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card m-4">
                <div class="card-header text-white theme_bg_color">OP Billing List</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped p-0 m-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Bill ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Billing Date</th>
                                    <th scope="col">Billed By</th>
                                    <th scope="col">Print Bill</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($opbillinglistdata)
                                    @if ($opbillinglistdata->isNotEmpty())
                                        @foreach ($opbillinglistdata as $key => $eachopbillinglistdata)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $eachopbillinglistdata->uniqid }}</td>
                                                <td>{{ $eachopbillinglistdata->total }}</td>
                                                <td>{{ $eachopbillinglistdata->discount }}</td>
                                                <td>{{ $eachopbillinglistdata->grand_total }}</td>
                                                <td>{{ $eachopbillinglistdata->created_at->format('d-m-Y h:i A') }}
                                                </td>
                                                <td>{{ $eachopbillinglistdata->creatable->name }}</td>
                                                <td>
                                                    <button
                                                        wire:click="printbillinglist({{ $eachopbillinglistdata->id }})"
                                                        type="button" class="btn btn-sm btn-success"><i
                                                            class="bi bi-printer"></i></button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No Record Found</td>
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
