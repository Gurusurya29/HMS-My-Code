<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">PRODUCT REPORT</span>
                </div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacy.reportindex') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="p-2">
                <div class="row">
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="startdateid" class="col-form-label fw-bold fs-6"> From Date :
                                        </label>

                                    </div>
                                    <div class="col-auto">
                                        <input type="date" wire:model="from_date"
                                            class="form-control form-control-sm" id="startdateid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="enddateid" class="col-form-label fw-bold fs-6">
                                            To Date : </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" wire:model="to_date" class="form-control form-control-sm"
                                            id="enddateid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="enddateid" class="col-form-label fw-bold fs-6">
                                            OPTIONS : </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select form-select-sm" wire:model="options">
                                            <option value="slowmoving">SLOW MOVING</option>
                                            <option value="fastmoving">FAST MOVING</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 col-md-3 float-end">
                        <input wire:model="searchTerm" type="text" class="form-control bg-white" placeholder="Product Search...">
                    </div>
                    <div class="col-1">
                        <select wire:click="updatepagination" wire:model.lazy="paginationlength"
                            class="form-select form-select-sm">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="col-md-3 text-start mt-1">
                            <button wire:loading.remove wire:target="export" wire:click="export"
                                class="btn btn-sm btn-success fw-bold"> Excel
                                <i class="bi bi-arrow-down"></i></button>
                            <div wire:loading wire:target="export" wire:loading.class="m-2">
                                <div class="spinner-border loadingspinner" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <button wire:loading.remove wire:target="pdf" wire:click="pdf"
                                class="btn btn-sm btn-success fw-bold"> PDF
                                <i class="bi bi-arrow-down"></i></button>
                            <div wire:loading wire:target="pdf" wire:loading.class="m-2">
                                <div class="spinner-border loadingspinner" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <button wire:click="clear" class="btn btn-sm btn-secondary"> Clear</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="labpatientreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>UNIQID</th>
                            <th>SKU</th>
                            <th>HSN</th>
                            <th>NAME</th>
                            <th>CATEGORY</th>
                            <th>CURRENT STOCK</th>
                            <th>CREATED BY</th>
                            <th>TOTAL SALES</th>
                            <th>PURCHASE RETURNS</th>
                            <th>SALES RETURNS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pharmacyproduct as $key => $item)
                            <tr>
                                <td>{{ $pharmacyproduct->firstItem() + $key }}</td>
                                <td>{{ $item->uniqid }}</td>
                                <td>{{ $item->product_sku }}</td>
                                <td>{{ $item->hsn }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->pharmacycategoryname?->name }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>{{ $item->creatable->name }}</td>
                                <td>{{ $item->totalsales }}</td>
                                <td>{{ $item->returncount }}</td>
                                <td>{{ $item->salesreturncount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {!! $pharmacyproduct->links() !!}
            </div>
        </div>
    </div>
</div>
