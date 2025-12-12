<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">HOSPITAL LEDGER REPORT</span>
                </div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('adminreports') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row g-3 align-items-center p-2">
                <div class="col-auto">
                    <label for="startdateid" class="col-form-label fw-bold fs-6"> From Date :
                    </label>

                </div>
                <div class="col-auto">
                    <input type="date" wire:model="from_date" class="form-control form-control-sm" id="startdateid">
                </div>


                <div class="col-auto">
                    <label for="enddateid" class="col-form-label fw-bold fs-6">
                        To Date : </label>
                </div>
                <div class="col-auto">
                    <input type="date" wire:model="to_date" class="form-control form-control-sm" id="enddateid">
                </div>

                <div class="col-auto">
                    <input type="text" wire:model="searchTerm" id="searchitem" class="form-control form-control-sm"
                        placeholder="Search" aria-describedby="passwordHelpInline">
                </div>

                <div class="col-auto text-start mt-3">
                    <button wire:click="export" class="btn btn-sm btn-success fw-bold"> Excel
                        <i class="bi bi-arrow-down"></i></button>
                    <button wire:click="pdf" class="btn btn-sm btn-success fw-bold"> PDF
                        <i class="bi bi-arrow-down"></i></button>
                    <button wire:click="clear" class="btn btn-sm btn-secondary"> Clear</button>
                </div>

                <div class="col-auto">
                    <select wire:click="updatepagination" wire:model.lazy="paginationlength"
                        class="form-select form-select-sm ">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <h4 class="fw-bold mx-4 my-3 text-end fs-6">Total Collected : <span class="text-primary">Rs.
                        {{ $balance_statement_credit }}</span></h5>
                    <h4 class="fw-bold mx-4 my-3 text-end fs-6">Total Billed : <span class="text-danger">Rs.
                            {{ $balance_statement_debit }}</span></h5>
                        <h4 class="fw-bold mx-4 my-3 text-end fs-6">Balance : <span class="text-success">Rs.
                                {{ $balance }}</span></h5>
            </div>
            <div class="table-responsive">
                <table id="hospitalstatementreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>DATE</th>
                            <th>BILL / RECEIPT ID</th>
                            <th>COLLECTED</th>
                            <th>BILLED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hospitalstatement as $key => $item)
                            <tr>
                                <td>{{ $hospitalstatement->firstItem() + $key }}</td>
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
                {!! $hospitalstatement->links() !!}
            </div>
        </div>
    </div>
</div>
