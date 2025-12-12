<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">BILL DISCOUNT/CANCEL REPORT</span></div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('adminreports') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row g-2 p-3">
                <div class="col-md-4">
                    <div class="row">
                        <label for="discounttypeid" class="col-5 col-form-label fw-bold">Discount Type :</label>
                        <div class="col-7">
                            <select class="form-select form-select-sm" wire:model.lazy="discounttype"
                                id="discounttypeid">
                                <option selected>Select Type</option>
                                @foreach ($discounttypedata as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" row">
                        <label for="bill_typeid" class="col-5 col-form-label fw-bold">Bill Type :</label>
                        <div class="col-7">
                            <select class="form-select form-select-sm" wire:model.lazy="bill_type" id="bill_typeid">
                                <option value>Select Bill Type</option>
                                @foreach ($bill_typedata as $key => $value)
                                    <option value="{{ $value['id'] }}">{{ $value['subtype'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" row">
                        <label for="startdateid" class="col-5 col-form-label fw-bold">From Date :</label>
                        <div class="col-7">
                            <input type="date" wire:model="from_date" class="form-control form-control-sm"
                                id="startdateid">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" row">
                        <label for="startdateid" class="col-5 col-form-label fw-bold">To Date :</label>
                        <div class="col-7">
                            <input type="date" wire:model="to_date" class="form-control form-control-sm"
                                id="startdateid">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <input type="text" wire:model="searchTerm" id="searchitem" class="form-control form-control-sm"
                        placeholder="Search">
                </div>
                <div class="col-md-3">
                    <button wire:click="export" class="btn btn-sm btn-success fw-bold"> Excel
                        <i class="bi bi-arrow-down"></i></button>
                    <button wire:click="pdf" class="btn btn-sm btn-success fw-bold"> PDF
                        <i class="bi bi-arrow-down"></i></button>
                    <button wire:click="clear" class="btn btn-sm btn-secondary"> Clear</button>
                </div>
                <div class="col-md-1">
                    <select wire:click="updatepagination" wire:model.lazy="paginationlength"
                        class="form-select form-select-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <h4 class="fw-bold mx-4 my-3 text-end">Total Discount/Cancel Amount: <span class="text-primary">Rs.
                        {{ $totaldiscountamount }}</span></h5>
            </div>
            <div class="table-responsive">
                <table id="receiptreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>DISCOUNT/CANCEL ON</th>
                            <th>DISCOUNT/CANCEL ID</th>
                            <th>BILL ID</th>
                            <th>PATIENT</th>
                            <th>PHONE</th>
                            <th>AMOUNT</th>
                            <th>DISCOUNT TYPE</th>
                            <th>BILL TYPE</th>
                            <th>DISCOUNT/CANCEL BY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($billdiscount as $key => $item)
                            <tr>
                                <td>{{ $billdiscount->firstItem() + $key }}</td>
                                <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                                <td>{{ $item->uniqid }}</td>
                                <td>{{ $item->billdiscountable->uniqid }}</td>
                                <td>{{ $item->patient?->name }} ({{ $item->patient?->uhid }})</td>
                                <td>{{ $item->patient?->phone }}</td>
                                <td>{{ $item->discount_amount }}</td>
                                <td>{{ config('archive.discount_type')[$item->discount_type] }}</td>
                                <td> {{ $item->bill_type? collect(config('archive.bill_type'))->where('id', $item->bill_type)->first()['subtype']: '-' }}
                                </td>
                                <td>{{ $item->creatable->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $billdiscount->links() !!}
            </div>
        </div>
    </div>
</div>
