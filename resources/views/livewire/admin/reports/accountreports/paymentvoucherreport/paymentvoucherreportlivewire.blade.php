<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">PAYMENT VOUCHER REPORT</span></div>
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
                        <label for="paymentmodetypeid" class="col-5 col-form-label fw-bold">Payment Mode :</label>
                        <div class="col-7">
                            <select class="form-select form-select-sm" wire:model.lazy="paymentmodetype"
                                id="paymentmodetypeid">
                                <option selected>Select Payment Mode</option>
                                @foreach ($paymentmodetypedata as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
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
                    <div class=" row">
                        <label for="searchitem" class="col-5 col-form-label fw-bold">Search :</label>
                        <div class="col-7">
                            <input type="text" wire:model="searchTerm" id="searchitem"
                                class="form-control form-control-sm" placeholder="Search">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 text-center">
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
                <h4 class="fw-bold mx-4 my-3 text-end">Total Paid Amount: <span class="text-primary">Rs.
                        {{ $totalpaidamount }}</span></h5>
            </div>
            <div class="table-responsive">
                <table id="paymentreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>PAID ON</th>
                            <th>RECEIPT ID</th>
                            <th>NAME (ID)</th>
                            <th>PHONE</th>
                            <th>AMOUNT</th>
                            <th>PAYMENT MODE</th>
                            <th>PAID BY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentvoucher as $key => $item)
                            <tr>
                                <td>{{ $paymentvoucher->firstItem() + $key }}</td>
                                <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                                <td>{{ $item->paymentvoucher_uniqid }}</td>
                                <td>
                                    {{ $item->paymentvoucher_user }}
                                </td>
                                <td>
                                    {{ $item->paymentvoucher_phone }}
                                </td>
                                <td>{{ $item->paid_amount }}</td>
                                <td>{{ config('archive.modeofpayment')[$item->modeofpayment] }}</td>

                                <td>{{ $item->creatable->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $paymentvoucher->links() !!}
            </div>
        </div>
    </div>
</div>
