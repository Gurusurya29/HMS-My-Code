<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">SALES ENTRY</span>
                </div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacy.reportindex') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="p-3">
                <div class="row justify-content-between">
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <div class="row g-1 align-items-center">
                                    <div class="col-auto">
                                        <label for="startdateid" class="col-form-label fw-bold fs-5"> From Date :
                                        </label>

                                    </div>
                                    <div class="col-auto">
                                        <input type="date" wire:model="from_date" class="form-control" id="startdateid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row g-1 align-items-center">
                                    <div class="col-auto">
                                        <label for="enddateid" class="col-form-label fw-bold fs-5">
                                            To Date : </label>
                                    </div>

                                    <div class="col-auto">
                                        <input type="date" wire:model="to_date" class="form-control" id="enddateid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="g-1 align-items-center fw-bold mt-3">
                                    @livewire('pharmacy.common.patient.searchpatientlivewire', ['required' => false])
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="text-center mt-3">
                                <button wire:loading.remove wire:target="export" wire:click="export"
                                    class="btn btn-success fw-bold"> Excel
                                    <i class="bi bi-arrow-down"></i></button>
                                <div wire:loading wire:target="export" wire:loading.class="m-2">
                                    <div class="spinner-border loadingspinner" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <button wire:loading.remove wire:target="pdf" wire:click="pdf"
                                    class="btn btn-success fw-bold"> PDF
                                    <i class="bi bi-arrow-down"></i></button>
                                <div wire:loading wire:target="pdf" wire:loading.class="m-2">
                                    <div class="spinner-border loadingspinner" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <button wire:click="clear" class="btn btn-secondary"> Clear</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <select wire:click="updatepagination" wire:model.lazy="paginationlength" class="form-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-auto fw-bold mx-4 text-end fs-4">
                        Total Price: {{ $totalsales }}
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="labpatientreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>PATIENT NO.</th>
                            <th>SALES ENTRY ID</th>
                            <th>SALES MAINTYPE</th>
                            <th>SALES SUBTYPE</th>
                            <th>DOCTOR</th>
                            <th>PATIENT UHID</th>
                            <th>PATIENT NAME</th>
                            <th>GRAND TOTAL</th>
                            <th>TAXABLE AMOUNT</th>
                            <th>TAX AMOUNT</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>SALE DATE</th>
                            <th>CREATED BY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $key => $item)
                        <tr>
                            <td>{{ $sales->firstItem() + $key }}</td>
                            <td>{{ $item->patient->phone }}</td>
                            <td>{{ $item->uniqid }}</td>
                            <td>{{ $item->maintype }}</td>
                            <td>{{ $item->subtype }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            <td>{{ $item->patient->uhid }}</td>
                            <td>{{ $item->patient->name }}</td>
                            <td>{{ $item->grand_total }}</td>
                            <td>{{ $item->taxableamt }}</td>
                            <td>{{ $item->taxamt }}</td>
                            <td>{{ $item->cgst }}</td>
                            <td>{{ $item->sgst }}</td>
                            <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                            <td>{{ $item->creatable->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $sales->links() !!}
            </div>
        </div>
    </div>
</div>