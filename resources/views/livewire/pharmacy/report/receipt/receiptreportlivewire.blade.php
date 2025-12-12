<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">RECEIPT</span>
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
                                        <input type="date" wire:model="from_date" class="form-control"
                                            id="startdateid">
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
                            <div class="col-md-4">
                                <div class="g-1 align-items-center fw-bold mt-3">
                                    @include('helper.formhelper.form', [
                                        'type' => 'select',
                                        'fieldname' => 'modeofpayment',
                                        'labelname' => 'PAYMENT MODE',
                                        'labelidname' => 'modeofpaymentid',
                                        'default_option' => 'Select Mode',
                                        'option' => config('archive.modeofpayment'),
                                        'required' => true,
                                        'col' => 'col-md-10',
                                    ])
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
                    <div class="col-auto mt-4 gap-2">
                        <select wire:click="updatepagination" wire:model.lazy="paginationlength" class="form-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <div class="col-auto fw-bold mx-4 text-end fs-4">
                            Total Received Amount: {{ $totalamount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="labpatientreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>BILL NO</th>
                            <th>RECEIPT DATE</th>
                            <th>PATIENT PHONE NO.</th>
                            <th>PATIENT NAME</th>
                            <th>AMOUNT</th>
                            <th>MODE</th>
                            <th>COLLECTED BY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receiptentry as $key => $item)
                            <tr>
                                <td>{{ $receiptentry->firstItem() + $key }}</td>
                                <td>{{ $item->receipt_uniqid }}</td>
                                <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                                <td>{{ $item->patient->phone }}</td>
                                <td>{{ $item->patient?->name }}</td>
                                <td>{{ $item->received_amount }}</td>
                                <td>{{ config('archive')['modeofpayment'][$item->modeofpayment] }}</td>
                                <td>{{ $item->creatable->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $receiptentry->links() !!}
            </div>
        </div>
    </div>
</div>
