<div class="card">
    @if ($ipbillingdata)
        <div class="card-header text-white theme_bg_color d-flex justify-content-between">
            <div class="h5 mb-0">
                IP BILL | #{{ $ipbillingdata->patient->uhid }}</div>
            <div class="h5 mb-0">
                <span class="text-warning fw-bold">NAME :</span> {{ $ipbillingdata->patient->name }}
                |
                <span class="text-warning fw-bold">AGE :</span> {{ $ipbillingdata->patient->age ?? '-' }}|
                <span class="text-warning fw-bold">GENDER :</span>
                {{ $ipbillingdata->patient->gender ? Config::get('archive.gender')[$ipbillingdata->patient->gender] : '-' }}|

                <span class="text-warning fw-bold">PHONE :</span>
                {{ $ipbillingdata->patient->phone }}

                <span class="mx-3">
                    <a href="{{ route('ipbilling') }}" class="btn btn-sm btn-secondary">Back</a>
                </span>
            </div>
        </div>

        <div class="card-body p-0 m-0">
            <div class="table-responsive px-2 mt-1">
                <table class="table table-bordered shadow-sm table-success text-center w-100">
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
                            <td>{{ $ipbillingdata->patientvisit->uniqid }}</td>
                            <td>{{ $ipbillingdata->uniqid }}</td>
                            <td>{{ $ipbillingdata->sub_total }}</td>
                            <td>{{ $ipbillingdata->discount }}</td>
                            <td>{{ $ipbillingdata->total }}</td>
                            <td>{{ $ipbillingdata->billdiscount_amount }}</td>
                            <td>{{ $ipbillingdata->grand_total }}</td>
                            <td>{{ $balance < 0 ? abs($balance) : 0 }}</td>
                            <td>{{ $balance > 0 ? $balance : 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if (empty($ipbillingdata->billdiscount_type))
                <div class="row g-2 m-1">
                    <div class="">
                        <a href="{{ route('ipservicemaster') }}" target="_blank"
                            class="btn btn-sm btn-success shadow">Add
                            New
                            IP Billing
                            Service</a>
                    </div>
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
                                                @if (!empty($ipservicemasterlist))
                                                    @foreach ($ipservicemasterlist as $i => $eachipservicemasterlist)
                                                        <li wire:click="additem({{ $eachipservicemasterlist['id'] }},'ipservicemaster')"
                                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                            <h6> {{ $eachipservicemasterlist['name'] }} </h6>

                                                            <h5>
                                                                <span class=" badge bg-primary rounded-pill">Fee:
                                                                    @if ($ipbillingdata->ipadmission->billing_type == 1)
                                                                        {{ $eachipservicemasterlist['selffee'] }}
                                                                    @else
                                                                        {{ $eachipservicemasterlist['insurancefee'] }}
                                                                    @endif
                                                                </span>
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
                                        <button wire:click="additem()" type="button"
                                            class="btn btn-sm btn-success shadow">Add
                                            Temporary
                                            Service</button>
                                        @can('Ippaybill')
                                            <a href="{{ route('ipbillpayment', $ipbillingdata->uuid) }}"
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
                                                @if ($selectedipservicemasterlist)
                                                    @foreach ($selectedipservicemasterlist as $key => $eachselectedipservicemasterlist)
                                                        <tr>
                                                            <td>
                                                                @if ($eachselectedipservicemasterlist['ipservicemaster_id'])
                                                                    {{ $eachselectedipservicemasterlist['ipservice_name'] }}
                                                                @else
                                                                    <input
                                                                        wire:model.debounce.150ms="selectedipservicemasterlist.{{ $key }}.ipservice_name"
                                                                        type="text" class="form-control">
                                                                    @error('selectedipservicemasterlist.' . $key .
                                                                        '.ipservice_name')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($eachselectedipservicemasterlist['ipservicemaster_id'])
                                                                    {{ $eachselectedipservicemasterlist['ipservice_fee'] }}
                                                                @else
                                                                    <input
                                                                        wire:model.debounce.150ms="selectedipservicemasterlist.{{ $key }}.ipservice_fee"
                                                                        type="number" class="form-control"
                                                                        wire:keyup="billingservicecalc({{ $key }})"
                                                                        wire:change="billingservicecalc({{ $key }})">
                                                                    @error('selectedipservicemasterlist.' . $key .
                                                                        '.ipservice_fee')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input
                                                                    wire:model.debounce.150ms="selectedipservicemasterlist.{{ $key }}.quantity"
                                                                    type="number" class="form-control"
                                                                    placeholder="Qty"
                                                                    wire:keyup="billingservicecalc({{ $key }})"
                                                                    wire:change="billingservicecalc({{ $key }})">
                                                                @error('selectedipservicemasterlist.' . $key .
                                                                    '.quantity')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>

                                                            <td class="fw-bold fs-5">
                                                                Rs.{{ $selectedipservicemasterlist[$key]['final_amount'] }}
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
                                @if ($selectedipservicemasterlist)
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
                IP Service List
            </div>
            <div>
                @if ($ipbillingdata->discount == 0 &&
                    $ipbillingdata->ipbillingservicelist->isNotEmpty() &&
                    empty($ipbillingdata->billdiscount_type))
                    <button type="button" wire:click="openipbilldiscount"
                        class="btn btn-sm btn-info shadow-lg">Discount</button>
                @endif
                <button type="button" wire:click="printdetailedipbill({{ $ipbillingdata->id }})"
                    class="btn btn-sm btn-warning shadow-lg">Print Detailed Bill</button>
                <button type="button" wire:click="printconsolidatedipbill({{ $ipbillingdata->id }})"
                    class="btn btn-sm btn-warning shadow-lg">Print Consolidated Bill</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped p-0 m-0">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">IP Service</th>
                            <th scope="col">Category</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Serviced On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ipbillingservicelist as $index => $eachipbillingservicelist)
                            <tr>
                                <td>{{ $ipbillingservicelist->firstItem() + $index }}</td>
                                <td>{{ $eachipbillingservicelist->ipservice_name }}</td>
                                <td>{{ $eachipbillingservicelist->ipservicemaster ? $eachipbillingservicelist->ipservicemaster->ipservicecategory->name : '-' }}
                                <td>{{ $eachipbillingservicelist->ipservice_fee }}</td>
                                <td>{{ $eachipbillingservicelist->quantity }}</td>
                                <td>{{ $eachipbillingservicelist->final_amount }}</td>
                                </td>
                                <td>{{ $eachipbillingservicelist->created_at->format('d-m-Y h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex bd-highlight">
                    <div class="p-1 bd-highlight"> Showing {{ $ipbillingservicelist->firstItem() }} to
                        {{ $ipbillingservicelist->lastItem() }} out of
                        {{ $ipbillingservicelist->total() }} items</div>
                    <div class="ms-auto p-1 bd-highlight"> {{ $ipbillingservicelist->links() }}</div>
                </div>

            </div>

        </div>
    </div>
    @include('livewire.admin.billing.ipbilling.ipbillingdiscountmodal')
</div>
