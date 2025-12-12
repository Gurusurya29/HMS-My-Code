<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">PAYMENT VOUCHER</span>
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
                                    @include('helper.formhelper.form', [
                                        'type' => 'select',
                                        'fieldname' => 'payment_to',
                                        'labelname' => 'PAYMENT TO',
                                        'labelidname' => 'payment_to',
                                        'default_option' => 'Select a Option',
                                        'option' => config('archive.payment_to'),
                                        'required' => false,
                                        'col' => 'col-md-10',
                                    ])
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
                                        'required' => false,
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
                            Total Amount: {{ $totalamt }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="labpatientreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>VOUCHER NO</th>
                            <th>PAYMENT DATE</th>
                            <th>NAME (ID)</th>
                            <th>PHONE NO.</th>
                            <th>AMOUNT</th>
                            <th>MODE</th>
                            <th>CREATED BY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentvoucher as $key => $item)
                            <tr>
                                <td>{{ $paymentvoucher->firstItem() + $key }}</td>
                                <td>{{ $item->paymentvoucher_uniqid }}</td>
                                <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                                <td>{{ $item->paymentvoucher_user }}</td>
                                <td>{{ $item->paymentvoucher_phone }}</td>
                                <td>{{ $item->paid_amount }}</td>
                                <td>{{ config('archive')['modeofpayment'][$item->modeofpayment] }}</td>
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
