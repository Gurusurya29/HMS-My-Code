<div class="card-body bg-light">
    @include('livewire.admin.inpatient.ipnursingstation.common.ippatientregistrationdetails')
    <div class="row g-2 m-1">
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="mx-auto">
                        <div class="dropdown">
                            <input type="text" class="form-control" placeholder="Search Services..."
                                wire:model="searchquery"   wire:model.live.debounce.300ms="searchquery" />

                              <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                                <li class="ist-group-item d-flex justify-content-between align-items-center">
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
                                                    <span class=" badge bg-primary rounded-pill">
                                                        {{ $eachipservicemasterlist['uniqid'] }}</span>
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
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <form wire:submit.prevent="storeservice()" autocomplete="off" onkeydown="return event.key != 'Enter';">
                    <div class="card-header text-white theme_bg_color fs-5 d-flex justify-content-between">
                        <div>
                            Services Added
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-center p-0 m-0 w-100">
                                <thead class="text-white theme_bg_color">
                                    <tr>
                                        <th scope="col">Description</th>
                                        <th scope="col" style="width:10%;">Quantity</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($selectedipservicemasterlist)
                                        @foreach ($selectedipservicemasterlist as $key => $eachselectedipservicemasterlist)
                                            <tr>
                                                <td>
                                                    {{ $eachselectedipservicemasterlist['ipservice_name'] }}
                                                </td>
                                                <td>
                                                    <input
                                                        wire:model.debounce.150ms="selectedipservicemasterlist.{{ $key }}.quantity"
                                                        type="number" class="form-control" placeholder="Qty"
                                                        wire:keyup="billingservicecalc({{ $key }})"
                                                        wire:change="billingservicecalc({{ $key }})">
                                                    @error('selectedipservicemasterlist.' . $key . '.quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td class="text-center">
                                                    <button wire:click.prevent="removeitem({{ $key }})"
                                                        class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i>
                                                    </button>
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
                    </div>
                    @if (!empty($selectedipservicemasterlist))
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white theme_bg_color">IP Service List</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped p-0 m-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">IP Service</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Serviced On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ipnursingstationlist as $index => $eachipnursingstationlist)
                                    <tr>
                                        <td>{{ $ipnursingstationlist->firstItem() + $index }}</td>
                                        <td>{{ $eachipnursingstationlist->ipservice_name }}</td>
                                        <td>{{ $eachipnursingstationlist->quantity }}</td>
                                        <td>{{ $eachipnursingstationlist->ipservicemaster->ipservicecategory->name }}
                                        </td>
                                        <td>{{ $eachipnursingstationlist->created_at->format('d-m-Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex bd-highlight">
                            <div class="p-1 bd-highlight"> Showing {{ $ipnursingstationlist->firstItem() }} to
                                {{ $ipnursingstationlist->lastItem() }} out of
                                {{ $ipnursingstationlist->total() }} items</div>
                            <div class="ms-auto p-1 bd-highlight"> {{ $ipnursingstationlist->links() }}</div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white theme_bg_color">IP Assesment List</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped p-0 m-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">IP Assesment ID</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Assessed On</th>
                                    <th scope="col">View/Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ipassesmentlist as $index => $eachipassesmentlist)
                                    <tr>
                                        <td>{{ $ipassesmentlist->firstItem() + $index }}</td>
                                        <td>{{ $eachipassesmentlist->uniqid }}</td>
                                        <td>{{ $eachipassesmentlist->doctor->name }}</td>
                                        {{-- <td>{{ $eachipassesmentlist->doctorspecialization->name }}</td> --}}
                                        <td>{{ $eachipassesmentlist->created_at->format('d-m-Y h:i A') }}</td>
                                        <td>
                                            <button wire:click="show({{ $eachipassesmentlist->id }})"
                                                class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                                            <a href="{{ route('ipassesment', [$eachipassesmentlist->inpatient->uuid, $eachipassesmentlist->uuid]) }}"
                                                class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex bd-highlight">
                            <div class="p-1 bd-highlight"> Showing {{ $ipassesmentlist->firstItem() }} to
                                {{ $ipassesmentlist->lastItem() }} out of
                                {{ $ipassesmentlist->total() }} items</div>
                            <div class="ms-auto p-1 bd-highlight"> {{ $ipassesmentlist->links() }}</div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Show Modal -->
    @include('livewire.admin.inpatient.ipnursingstation.ipnursingstationservice.show')
</div>
