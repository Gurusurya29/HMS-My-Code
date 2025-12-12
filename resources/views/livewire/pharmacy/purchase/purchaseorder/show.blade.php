<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel">PURCHASE ORDER : {{ $showdata->uniqid }} </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @include('helper.formhelper.showlabel', [
                            'name' => 'UNIQID',
                            'value' => $showdata->uniqid,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SUPPLIER COMPANY NAME',
                            'value' => $showdata->supplier_companyname,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SUPPLIER MOBILE NUMBER',
                            'value' => $showdata->supplier_mobile_no,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PLANNING DATE',
                            'value' => Carbon\Carbon::parse($showdata->planning_date)->format('d-m-Y'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TOTAL',
                            'value' => $showdata->grand_total,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CGST',
                            'value' => $showdata->cgst,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'SGST',
                            'value' => $showdata->sgst,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TAX AMOUNT',
                            'value' => $showdata->taxamt,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TAXABLE AMOUNT',
                            'value' => $showdata->taxableamt,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'NOTE',
                            'value' => $showdata->note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED BY',
                            'value' => $showdata->creatable->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED AT',
                            'value' => $showdata->created_at->format('d-m-Y h:i A'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @if ($showdata->updatable)
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED BY',
                                'value' => $showdata->updatable->name,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED AT',
                                'value' => $showdata->updated_at->format('d-m-Y h:i A'),
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                        @endif

                        {{-- @if (count($showdata->poitems()) > 0) --}}
                        <div>
                            <div class="card shadow-sm mt-2">
                                <div class="card-header text-white bg-primary text-white">
                                    <div class="d-flex flex-row bd-highlight">
                                        <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">ORDER
                                                ITEMS</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <table class="table table-bordered text-center text-primary table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">ITEM</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">CGST</th>
                                        <th scope="col">CGST AMT</th>
                                        <th scope="col">SGST</th>
                                        <th scope="col">SGST AMT</th>
                                        <th scope="col">REQUIRED QTY</th>
                                        <th scope="col">RECEIVED QTY</th>
                                        <th scope="col">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-5 text-primary">
                                    @foreach ($showdata->showpoitems() as $value)
                                        <tr class="text-black">
                                            <td class="fw-bold">
                                                {{ $value->pharmacyproduct_name }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $value->price }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $value->cgst }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $value->cgst_amt }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $value->sgst }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $value->sgst_amt }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $value->quantity }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $value->received_quantity }}
                                            </td>
                                            <td>
                                                {{ $value->total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        @endif
    </div>
</div>
