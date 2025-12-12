<div class="card">
    @if ($otbillingdata)
        <div class="card-header text-white theme_bg_color d-flex justify-content-between">
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

                <span class="mx-3">
                    <a href="{{ route('otbilling') }}" class="btn btn-sm btn-secondary">Back</a>
                </span>
            </div>

        </div>


        <div class="card-body p-0 m-0">
            <div class="table-responsive px-5 mt-1">
                <table class="table table-bordered shadow-sm table-success text-center">
                    <thead class="fw-bold " style="font-size: 16px;">
                        <tr>
                            <th scope="col">Visit ID</th>
                            <th scope="col">OT Billing ID</th>
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
            @if (empty($otbillingdata->billdiscount_type))
                <div class="row g-2 m-1">
                    <div class="col-md-6">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="mx-auto">
                                    <div class="dropdown">
                                        <input type="text" class="form-control" placeholder="Search Services..."
                                            wire:model="searchquery" wire:model.live.debounce.300ms="searchquery"/>

                                          <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                                            <li
                                                class="ist-group-item d-flex justify-content-between align-items-center">
                                                Searching...</li>
                                        </ul>

                                        @if (!empty($searchquery))
                                            <ul class="dropdown-menu list-group w-100 p-0 bg-gray shadow-sm">
                                                @if (!empty($otservicemasterlist))
                                                    @foreach ($otservicemasterlist as $i => $eachotservicemasterlist)
                                                        <li wire:click="additem({{ $eachotservicemasterlist['id'] }},'otservicemaster')"
                                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                            <h6> {{ $eachotservicemasterlist['name'] }} </h6>

                                                            <h5>
                                                                <span class=" badge bg-primary rounded-pill">Fee:
                                                                    {{ $eachotservicemasterlist['selffee'] }}</span>
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
                        <div class="card">
                            <form wire:submit.prevent="storeservice()" autocomplete="off"
                                onkeydown="return event.key != 'Enter';">
                                <div class="card-header text-white theme_bg_color fs-5 d-flex justify-content-between">
                                    <div>
                                        Services Added
                                    </div>
                                    <div>
                                        @can('Otpaybill')
                                            <a href="{{ route('otbillpayment', $otbillingdata->uuid) }}"
                                                class="btn btn-sm btn-primary">Receipt Screen</a>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped p-0 m-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Description</th>
                                                    <th scope="col" style="width:20%;">Fee</th>
                                                    <th scope="col" style="width:10%;">Quantity</th>
                                                    <th scope="col">Amount</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($selectedotservicemasterlist)
                                                    @foreach ($selectedotservicemasterlist as $key => $eachselectedotservicemasterlist)
                                                        <tr>
                                                            <td>
                                                                @if ($eachselectedotservicemasterlist['ipservicemaster_id'])
                                                                    {{ $eachselectedotservicemasterlist['otservice_name'] }}
                                                                @else
                                                                    <input
                                                                        wire:model.debounce.150ms="selectedotservicemasterlist.{{ $key }}.otservice_name"
                                                                        type="text" class="form-control">
                                                                    @error('selectedotservicemasterlist.' . $key .
                                                                        '.otservice_name')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($eachselectedotservicemasterlist['ipservicemaster_id'])
                                                                    {{ $eachselectedotservicemasterlist['otservice_fee'] }}
                                                                @else
                                                                    <input
                                                                        wire:model.debounce.150ms="selectedotservicemasterlist.{{ $key }}.otservice_fee"
                                                                        type="number" class="form-control">
                                                                    @error('selectedotservicemasterlist.' . $key .
                                                                        '.otservice_fee')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input
                                                                    wire:model.debounce.150ms="selectedotservicemasterlist.{{ $key }}.quantity"
                                                                    type="number" class="form-control"
                                                                    placeholder="Qty"
                                                                    wire:keyup="billingservicecalc({{ $key }})"
                                                                    wire:change="billingservicecalc({{ $key }})">
                                                                @error('selectedotservicemasterlist.' . $key .
                                                                    '.quantity')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td class="fw-bold fs-5">
                                                                Rs.{{ $selectedotservicemasterlist[$key]['final_amount'] }}
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
                                                        <td colspan="5" class="text-muted">No record found
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if ($selectedotservicemasterlist)
                                    <div class="mt-2">
                                        <div class="fs-5 fw-bold text-end mx-4">
                                            Total: <span class="fw-semibold">Rs.{{ $total }}</span>
                                        </div>
                                    </div>
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
            @endif
        </div>
    @endif

    <div class="card m-4">
        <div class="card-header text-white theme_bg_color d-flex justify-content-between">
            <div>
                OT Service List
            </div>
            <div>
                @if ($otbillingdata->discount == 0 &&
                    $otbillingdata->otbillingservicelist->isNotEmpty() &&
                    empty($otbillingdata->billdiscount_type))
                    <button type="button" wire:click="openotbilldiscount"
                        class="btn btn-sm btn-info shadow-lg">Discount</button>
                @endif
                <button type="button" wire:click="printotbill({{ $otbillingdata->id }})"
                    class="btn btn-sm btn-warning shadow-lg">Print Bill</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped p-0 m-0">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">OT Service</th>
                            <th scope="col">Category</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Serviced On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($otbillingservicelist as $index => $eachotbillingservicelist)
                            <tr>
                                <td>{{ $otbillingservicelist->firstItem() + $index }}</td>
                                <td>{{ $eachotbillingservicelist->otservice_name }}</td>
                                <td>{{ $eachotbillingservicelist->ipservicemaster->ipservicecategory->name }}
                                <td>{{ $eachotbillingservicelist->otservice_fee }}</td>
                                <td>{{ $eachotbillingservicelist->quantity }}</td>
                                <td>{{ $eachotbillingservicelist->final_amount }}</td>
                                </td>
                                <td>{{ $eachotbillingservicelist->created_at->format('d-m-Y h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex bd-highlight">
                    <div class="p-1 bd-highlight"> Showing {{ $otbillingservicelist->firstItem() }} to
                        {{ $otbillingservicelist->lastItem() }} out of
                        {{ $otbillingservicelist->total() }} items</div>
                    <div class="ms-auto p-1 bd-highlight"> {{ $otbillingservicelist->links() }}</div>
                </div>

            </div>

        </div>
    </div>
    @include('livewire.admin.billing.otbilling.otbillingdiscountmodal')
</div>
