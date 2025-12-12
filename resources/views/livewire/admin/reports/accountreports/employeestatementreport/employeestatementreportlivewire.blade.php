<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">EMPLOYEE LEDGER REPORT</span>
                </div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('adminreports') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 row justify-content-center">
            <div class="my-3 col-md-8">
                <div class="dropdown">
                    <label class="form-label fs-6" for="searchquery">Search Employee :</label>
                    <input type="text" class="form-control form-control-sm shadow-sm border border-1 border-info"
                        id="searchquery" placeholder="Search Employee..." wire:model="searchquery"   wire:model.live.debounce.300ms="searchquery" />

                      <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                        <li class="ist-group-item d-flex justify-content-between align-items-center">
                            Searching...</li>
                    </ul>

                    @if (!empty($searchquery))
                        <ul class="dropdown-menu list-group w-100 p-0">
                            @if (!empty($employeelist))
                                @foreach ($employeelist as $i => $eachemployeelist)
                                    <li wire:click="selectedemployee({{ $eachemployeelist['id'] }})"
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                        role="button">
                                        <h6> {{ $eachemployeelist['name'] }} </h6>

                                        <h5>
                                            <span class=" badge bg-primary rounded-pill">
                                                {{ $eachemployeelist['uniqid'] }}</span>
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
            @if ($employee)
                <div class="table-responsive col-md-8">
                    <table class="table table-bordered border-secondary shadow-sm table-success text-center">
                        <thead class="fw-bold " style="font-size: 16px;">
                            <tr>
                                <th scope="col">UHID</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">DOB</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fs-5">
                                <td>{{ $employee->uniqid ?? '-' }}</td>
                                <td>{{ $employee->name ?? '-' }}</td>
                                <td>{{ $employee->phone ?? '-' }}</td>
                                <td>{{ $employee->dob ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    <div class="row g-3 align-items-center p-2">
                        <div class="col-auto">
                            <label for="startdateid" class="col-form-label fw-bold fs-5"> From Date :
                            </label>

                        </div>
                        <div class="col-auto">
                            <input type="date" wire:model="from_date" class="form-control form-control-sm"
                                id="startdateid">
                        </div>


                        <div class="col-auto">
                            <label for="enddateid" class="col-form-label fw-bold fs-5">
                                To Date : </label>
                        </div>
                        <div class="col-auto">
                            <input type="date" wire:model="to_date" class="form-control form-control-sm"
                                id="enddateid">
                        </div>

                        <div class="col-auto">
                            <input type="text" wire:model="searchTerm" id="searchitem"
                                class="form-control form-control-sm" placeholder="Search"
                                aria-describedby="passwordHelpInline">
                        </div>

                        <div class="col-auto text-start">
                            <button wire:click="export" class="btn btn-sm btn-success fw-bold"> Excel
                                <i class="bi bi-arrow-down"></i></button>
                            <button wire:click="pdf" class="btn btn-sm btn-success fw-bold"> PDF
                                <i class="bi bi-arrow-down"></i></button>
                            <button wire:click="clear" class="btn btn-sm btn-secondary"> Clear</button>
                        </div>

                        <div class="col-auto">
                            <select wire:click="updatepagination" wire:model.lazy="paginationlength"
                                class="form-select form-select-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <h4 class="fw-bold mx-4 my-3 text-end">Total Collected : <span class="text-primary">Rs.
                            {{ $balance_statement ? $balance_statement->sum('credit') : 0 }}</span></h5>
                        <h4 class="fw-bold mx-4 my-3 text-end">Total Billed : <span class="text-danger">Rs.
                                {{ $balance_statement ? $balance_statement->sum('debit') : 0 }}</span></h5>
                            <h4 class="fw-bold mx-4 my-3 text-end">Balance : <span class="text-success">Rs.
                                    {{ $balance }}</span></h5>
                </div>
                <div class="table-responsive">
                    <table id="employeestatementreport_id" class="table text-center table-hover m-0 p-0">
                        <thead class="text-white theme_bg_color">
                            <tr>
                                <th>S.NO</th>
                                <th>DATE</th>
                                <th>STATEMENT ID</th>
                                <th>COLLECTED</th>
                                <th>BILLED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeestatement as $key => $item)
                                <tr>
                                    <td>{{ $employeestatement->firstItem() + $key }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                                    <td>
                                        {{ $item->statement_ref_id }}
                                    </td>
                                    <td>{{ $item->credit }}</td>
                                    <td>{{ $item->debit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $employeestatement->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
