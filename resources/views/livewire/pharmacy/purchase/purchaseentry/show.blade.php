<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel">PURCHASE ENTRY : {{ $showdata->uniqid }} </h5>
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
                            'value' => $showdata->pharmpurchaseorder->supplier_companyname,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CONTACT NAME',
                            'value' => $showdata->pharmpurchaseorder->supplier_contact_name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'MOBILE NUMBER',
                            'value' => $showdata->pharmpurchaseorder->supplier_mobile_no,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TAX AMT',
                            'value' => $showdata->taxamt,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TAXABLE AMT',
                            'value' => $showdata->taxableamt,
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
                            'name' => 'GRAND TOTAL',
                            'value' => $showdata->grand_total,
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
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered text-center table-light w-full">
                                <tbody>
                                    @foreach ($showdata->pharmpurchaseorder->poitems as $key => $value)
                                        <tr class="text-black pt-5">
                                            @php
                                                if ($value->received_quantity == 0) {
                                                    $color = 'customdanger';
                                                } elseif ($value->received_quantity >= $value->quantity) {
                                                    $color = 'bg-success';
                                                } elseif ($value->received_quantity < $value->quantity) {
                                                    $color = 'customwarning';
                                                }
                                            @endphp
                                            <table class="table table-bordered {{ $color }} text-white">
                                                <tr>
                                                    <td style="width: 5%;"
                                                        class="bg-white fw-bold text-black text-center">
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td style="width: 35%;">
                                                        <div class="d-flex gap-2">
                                                            <span>
                                                                PRODUCT NAME :
                                                            </span>
                                                            <span class="fw-bold">
                                                                {{ $value->pharmacyproduct_name }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <div class="d-flex gap-2">
                                                            <span>
                                                                ORDERED QUANTITY :
                                                            </span>
                                                            <span class="fw-bold">
                                                                {{ $value->quantity }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <div class="d-flex gap-2">
                                                            <span>
                                                                RECEIVED QUANTITY :
                                                            </span>
                                                            <span class="fw-bold">
                                                                {{ $value->received_quantity }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="d-flex gap-2">
                                                            <span>
                                                                BALANCE QUANTITY :
                                                            </span>
                                                            <span class="fw-bold">
                                                                {{ $value->quantity > $value->received_quantity ? $value->quantity - $value->received_quantity : 0 }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            @php
                                                $itemlist = $value->purchasebasedentryitem($showdata->id);
                                            @endphp
                                            @if (count($itemlist) != 0)
                                                <table class="table table-light my-2 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">BATCH
                                                            </th>
                                                            <th class="text-center" scope="col">EXPIRY DATE</th>
                                                            <th class="text-center" scope="col">QUANTITY
                                                            </th>
                                                            <th class="text-center" scope="col">CGST </th>
                                                            <th class="text-center" scope="col">CGST AMOUNT
                                                            </th>
                                                            <th class="text-center" scope="col">SGST
                                                            </th>
                                                            <th class="text-center" scope="col">SGST AMOUNT
                                                            </th>
                                                            <th class="text-center" scope="col">PURCHASE PRICE
                                                            </th>
                                                            <th class="text-center" scope="col">SELLING PRICE
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($itemlist as $subindexvalue)
                                                        <tr>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->batch }}</td>
                                                            <td class="text-center fw-bold">
                                                                {{ Carbon\Carbon::parse($subindexvalue->expiry_date)->format('m-d-Y') }}
                                                            </td>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->received_quantity }}
                                                            </td>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->cgst }}
                                                            </td>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->cgst_amt }}
                                                            </td>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->sgst }}
                                                            </td>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->sgst_amt }}
                                                            </td>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->purchase_price }}
                                                            </td>
                                                            <td class="text-center fw-bold">
                                                                {{ $subindexvalue->selling_price }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @php
                        $count = $this->additionalitems() ? count($this->additionalitems()->nonpoitems()) : 0;
                    @endphp
                    @if ($count != 0)
                        <div class="p-3">
                            <div class="card shadow-sm">
                                <div class="card-header text-white {{ isset($theme) ? $theme : 'theme_bg_color' }}">
                                    <div class="d-flex flex-row bd-highlight">
                                        <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Additional
                                                Products</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-light table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">PRODUCT NAME
                                        </th>
                                        <th class="text-center" scope="col">BATCH
                                        </th>
                                        <th class="text-center" scope="col">EXPIRY DATE</th>
                                        <th class="text-center" scope="col">QUANTITY
                                        </th>
                                        <th class="text-center" scope="col">MRP
                                        </th>
                                        <th class="text-center" scope="col">SELLING PRICE
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($this->additionalitems()->nonpoitems() as $subindexvalue)
                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ $subindexvalue->pharmproduct->name }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            {{ $subindexvalue->batch }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            {{ Carbon\Carbon::parse($subindexvalue->expiry_date)->format('m-d-Y') }}
                                        </td>
                                        </td>
                                        <td class="text-center fw-bold">
                                            {{ $subindexvalue->received_quantity }}
                                        </td>
                                        <td class="text-center fw-bold">{{ $subindexvalue->mrp }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            {{ $subindexvalue->selling_price }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        @endif
    </div>
</div>
