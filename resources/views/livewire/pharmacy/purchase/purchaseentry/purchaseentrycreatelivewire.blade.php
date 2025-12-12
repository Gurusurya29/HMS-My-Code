<div>
    <div class="bg-white p-2 shadow-sm">
        <div class="row g-2 p-3 w-75 mx-auto">
            <div class="col-md-6">
                @livewire('pharmacy.common.supplier.searchsupplierlivewire')
            </div>
            <div class="col-md-6 position-relative">
                <label for="po" class="form-label">PURCHASE ORDER UNIQID</label>
                <span class="text-danger fw-bold">*</span>
                <input autocomplete="off" type="text" class="form-control" id="po"
                    placeholder="Search Purchase Order..." wire:model="po" wire:keydown.escape="resetData"
                    wire:keydown.arrow-up="decrementHighlight" wire:keydown.arrow-down="incrementHighlight"
                    wire:keydown.enter="selectPo" />
                @if (!empty($polist))
                    <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
                    <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:99%">
                        @if ($isposelected === false)
                            @if (!empty($polist))
                                @foreach ($polist as $i => $eachpo)
                                    <div type="button" wire:click='selecthispo({{ $eachpo['id'] }})'
                                        class="search-option-list list-item p-1 text-sm {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                                        {{ $eachpo['uniqid'] }} - {{ $eachpo['supplier_companyname'] }} -
                                        {{ $eachpo['supplier_mobile_no'] }}</div>
                                @endforeach
                            @else
                                <div class="list-item p-1">No results!</div>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="justify-content-center mt-5" wire:loading wire:loading.class="d-flex"
            wire:target="selectPo, selecthispo">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        @if ($isposelected)
            <div class="d-flex gap-2 mx-auto" style="width: 90%;">
                @include('livewire.pharmacy.purchase.purchaseentry.purchaseorderdetail', [
                    'po' => $selectedpo,
                    'width' => 'w-full',
                ])
                @include('livewire.pharmacy.purchase.supplier.supplierdetail', [
                    'supplier' => $supplier,
                    'width' => 'w-full',
                ])
            </div>
            <div class="p-3" id="poitmes">
                <div class="card shadow-sm mt-2">
                    <div class="card-header text-white theme_bg_color text-white">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Items</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if (sizeof($poitems) > 0)
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered text-center table-light w-full">
                                <tbody>
                                    @foreach ($poitems as $value)
                                        @if ($value->quantity > $value->received_quantity)
                                            <tr class="text-black pt-5">
                                                @php
                                                    if ($value->received_quantity == 0) {
                                                        $color = 'customdanger';
                                                    } elseif ($value->received_quantity < $value->quantity) {
                                                        $color = 'customwarning';
                                                    }
                                                @endphp
                                                <table class="table table-bordered {{ $color }} text-white">
                                                    <tr>
                                                        <td style="width: 40%;">
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
                                                        <td
                                                            class="bg-light text-center d-flex justify-content-center align-items-center gap-2">
                                                            <button class="btn btn-sm bg-success text-white fw-bold"
                                                                wire:click="addcol({{ $value->id }})">ADD</button>
                                                            <button class="btn btn-sm bg-danger text-white fw-bold"
                                                                wire:click="clearallcol({{ $value->id }})">
                                                                CLEAR ALL
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                @if (count($value->pruchaseentryitem) != 0)
                                                    <table class="table table-light w-75 mx-auto my-2 table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" scope="col">BATCH
                                                                </th>
                                                                <th class="text-center" scope="col">EXPIRY DATE</th>
                                                                <th scope="col">CGST %</th>
                                                                <th scope="col">CGST <br>AMOUNT</th>
                                                                <th scope="col">SGST %</th>
                                                                <th scope="col">SGST <br>AMOUNT</th>
                                                                <th class="text-center" scope="col">QUANTITY</th>
                                                                <th class="text-center" scope="col">PURCHASE PRICE
                                                                </th>
                                                                <th class="text-center" scope="col">SELLING PRICE
                                                                </th>
                                                                <th class="text-center" scope="col">TOTAL
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        @foreach ($value->pruchaseentryitem as $subindexvalue)
                                                            <tr>
                                                                <td class="text-center fw-bold">
                                                                    {{ $subindexvalue->batch }}</td>
                                                                <td class="text-center fw-bold">
                                                                    {{ Carbon\Carbon::parse($subindexvalue->expiry_date)->format('m-d-Y') }}
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
                                                                    {{ $subindexvalue->quantity }}
                                                                </td>
                                                                <td class="text-center fw-bold">
                                                                    {{ $subindexvalue->purchase_price }}
                                                                </td>
                                                                <td class="text-center fw-bold">
                                                                    {{ $subindexvalue->selling_price }}</td>
                                                                <td class="text-center fw-bold">
                                                                    {{ $subindexvalue->total }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @endif
                                                @if (count($inward[$value->id]) != 0)
                                                    <table class="table-bordered table">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">BATCH
                                                                </th>
                                                                <th class="text-center">EXPIRY DATE</th>
                                                                <th class="text-center">CGST %</th>
                                                                <th class="text-center">CGST <br>AMOUNT</th>
                                                                <th class="text-center">SGST %</th>
                                                                <th class="text-center">SGST <br>AMOUNT</th>
                                                                <th class="text-center">QUANTITY
                                                                </th>
                                                                <th class="text-center">PURCHASE PRICE
                                                                </th>
                                                                <th class="text-center">SELLING PRICE
                                                                </th>
                                                                <th class="text-center">TOTAL
                                                                </th>
                                                                <th class="text-center" colspan="2">ACTION
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($inward[$value->id] as $secondkey => $childvalue)
                                                                <tr>
                                                                    <td style="width: 10%">
                                                                        <input type="text"
                                                                            wire:model.delay="inward.{{ $value->id }}.{{ $secondkey }}.batch"
                                                                            class="form-control bg-white text-center"
                                                                            placeholder="batch">
                                                                        @error('inward.' . $value->id . '.' . $secondkey
                                                                            . '.batch')
                                                                            <span
                                                                                class="text-danger fw-bold">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td style="width: 10%">
                                                                        <input type="date"
                                                                            wire:model.delay="inward.{{ $value->id }}.{{ $secondkey }}.expiry_date"
                                                                            class="form-control bg-white">
                                                                        @error('inward.' . $value->id . '.' . $secondkey
                                                                            . '.expiry_date')
                                                                            <span
                                                                                class="text-danger fw-bold">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ $inward[$value->id][$secondkey]['sgst'] }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ number_format((float) $inward[$value->id][$secondkey]['sgst_amount'], 2, '.', '') }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ $inward[$value->id][$secondkey]['cgst'] }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ number_format((float) $inward[$value->id][$secondkey]['cgst_amount'], 2, '.', '') }}
                                                                    </td>
                                                                    <td style="width: 10%">
                                                                        <input type="quantity"
                                                                            wire:change="productlivevalidation('{{ $value->id }}','{{ $secondkey }}')"
                                                                            wire:keyup="productlivevalidation('{{ $value->id }}','{{ $secondkey }}')"
                                                                            wire:model.delay="inward.{{ $value->id }}.{{ $secondkey }}.quantity"
                                                                            class="form-control bg-white text-center"
                                                                            placeholder="quantity">
                                                                        @error('inward.' . $value->id . '.' . $secondkey
                                                                            . '.quantity')
                                                                            <span
                                                                                class="text-danger fw-bold">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td style="width: 10%">
                                                                        <input type="mrp"
                                                                            wire:change="productlivevalidation('{{ $value->id }}','{{ $secondkey }}')"
                                                                            wire:keyup="productlivevalidation('{{ $value->id }}','{{ $secondkey }}')"
                                                                            wire:model.delay="inward.{{ $value->id }}.{{ $secondkey }}.mrp"
                                                                            class="form-control bg-white text-end"
                                                                            placeholder="mrp">
                                                                        @error('inward.' . $value->id . '.' . $secondkey
                                                                            . '.mrp')
                                                                            <span
                                                                                class="text-danger fw-bold">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td style="width: 10%">
                                                                        <input type="selling_price"
                                                                            wire:model.delay="inward.{{ $value->id }}.{{ $secondkey }}.selling_price"
                                                                            class="form-control bg-white text-end"
                                                                            placeholder="selling_price">
                                                                        @error('inward.' . $value->id . '.' . $secondkey
                                                                            . '.selling_price')
                                                                            <span
                                                                                class="text-danger fw-bold">{{ $message }}</span>
                                                                        @enderror
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ number_format((float) $inward[$value->id][$secondkey]['total'], 2, '.', '') }}
                                                                    </td>
                                                                    <td class="text-center" style="width:4%">
                                                                        <button
                                                                            {{ array_key_last($inward[$value->id]) == $secondkey ? '' : 'hidden' }}
                                                                            wire:click="addcol({{ $value->id }})">
                                                                            <i class="bi bi-plus text-success"
                                                                                style="font-size: 1.2rem;"></i>
                                                                        </button>
                                                                        <button
                                                                            wire:click="subcol({{ $value->id }}, {{ $secondkey }})"
                                                                            {{ $secondkey == 0 ? 'hidden' : '' }}>
                                                                            <i class="bi bi-trash text-danger"
                                                                                style="font-size: 1.2rem;"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="text-center fw-bold">
                        No Records..
                    </div>
                @endif
            </div>
            @php
                $count = $this->additionalitems() ? count($this->additionalitems()->nonpoitems()) : 0;
            @endphp
            @if ($count != 0)
                <div class="p-3 w-75 mx-auto">
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
                                <th scope="col">CGST %</th>
                                <th scope="col">CGST <br>AMOUNT</th>
                                <th scope="col">SGST %</th>
                                <th scope="col">SGST <br>AMOUNT</th>
                                <th class="text-center" scope="col">QUANTITY
                                </th>
                                <th class="text-center" scope="col">PRUCHASE PRICE
                                </th>
                                <th class="text-center" scope="col">SELLING PRICE
                                </th>
                                <th class="text-center" scope="col">TOTAL
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
                                    {{ $subindexvalue->quantity }}
                                </td>
                                <td class="text-center fw-bold">{{ $subindexvalue->purchase_price }}
                                </td>
                                <td class="text-center fw-bold">
                                    {{ $subindexvalue->selling_price }}</td>
                                <td class="text-center fw-bold">
                                    {{ $subindexvalue->total }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
            <div class="w-50 mx-auto">
                @livewire('pharmacy.common.pharmacyproduct.searchpharmacyproductlivewire', [
                    'supplier_id' => $supplier_id,
                    'ignoreids' => $ignoreids,
                ])
            </div>
            {{-- Additional Product --}}
            <div class="p-3">
                <div class="card shadow-sm">
                    <div class="card-header text-white {{ isset($theme) ? $theme : 'theme_bg_color' }}">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Additional
                                    Products (Manual)</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if (sizeof($extproductid) > 0)
                    <div class="card-body">
                        @foreach ($extproductid as $key => $value)
                            <div>
                                <table class="table table-bordered {{ $color }} text-white">
                                    <tr>
                                        <td style="width: 40%;">
                                            <div class="d-flex gap-2">
                                                <span>
                                                    PRODUCT NAME :
                                                </span>
                                                <span class="fw-bold">
                                                    {{ $productname[$key] }}
                                                </span>
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="d-flex gap-2">
                                                <span>
                                                    CURRENT STOCK :
                                                </span>
                                                <span class="fw-bold">
                                                    {{ $productqty[$key] }}
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                            class="bg-light text-center d-flex justify-content-center align-items-center gap-2">
                                            <button class="btn btn-sm bg-success text-white fw-bold"
                                                wire:click="addextcol('{{ $productuuid[$key] }}')">ADD</button>
                                            <button class="btn btn-sm bg-danger text-white fw-bold"
                                                wire:click="clearallextcol('{{ $productuuid[$key] }}')">
                                                CLEAR ALL
                                            </button>
                                            <button wire:click="deleteext('{{ $productuuid[$key] }}')">
                                                <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                                @if (count($inward[$productuuid[$key]]) != 0)
                                    <table class="table-bordered table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">BATCH
                                                </th>
                                                <th class="text-center" scope="col">EXPIRY DATE</th>
                                                <th class="text-center">CGST %</th>
                                                <th class="text-center">CGST <br>AMOUNT</th>
                                                <th class="text-center">SGST %</th>
                                                <th class="text-center">SGST <br>AMOUNT</th>
                                                <th class="text-center" scope="col">QUANTITY
                                                </th>
                                                <th class="text-center" scope="col">PURCHASE PRICE
                                                </th>
                                                <th class="text-center" scope="col">SELLING PRICE
                                                </th>
                                                <th class="text-center" scope="col">TOTAL
                                                </th>
                                                <th class="text-center" scope="col" colspan="2">ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inward[$productuuid[$key]] as $secondkey => $childvalue)
                                                <tr>
                                                    <td style="width: 10%">
                                                        <input type="text"
                                                            wire:model.delay="inward.{{ $productuuid[$key] }}.{{ $secondkey }}.batch"
                                                            class="form-control bg-white text-center"
                                                            placeholder="batch">
                                                        @error('inward.' . $productuuid[$key] . '.' . $secondkey .
                                                            '.batch')
                                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="width: 10%">
                                                        <input type="date"
                                                            wire:model.delay="inward.{{ $productuuid[$key] }}.{{ $secondkey }}.expiry_date"
                                                            class="form-control bg-white">
                                                        @error('inward.' . $productuuid[$key] . '.' . $secondkey .
                                                            '.expiry_date')
                                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $inward[$productuuid[$key]][$secondkey]['sgst'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format((float) $inward[$productuuid[$key]][$secondkey]['sgst_amount'], 2, '.', '') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $inward[$productuuid[$key]][$secondkey]['cgst'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format((float) $inward[$productuuid[$key]][$secondkey]['cgst_amount'], 2, '.', '') }}
                                                    </td>
                                                    <td style="width: 10%">
                                                        <input type="quantity"
                                                            wire:change="productlivevalidation('{{ $productuuid[$key] }}','{{ $secondkey }}')"
                                                            wire:keyup="productlivevalidation('{{ $productuuid[$key] }}','{{ $secondkey }}')"
                                                            wire:model.delay="inward.{{ $productuuid[$key] }}.{{ $secondkey }}.quantity"
                                                            class="form-control bg-white text-center"
                                                            placeholder="quantity">
                                                        @error('inward.' . $productuuid[$key] . '.' . $secondkey .
                                                            '.quantity')
                                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="width: 10%">
                                                        <input type="mrp"
                                                            wire:change="productlivevalidation('{{ $productuuid[$key] }}','{{ $secondkey }}')"
                                                            wire:keyup="productlivevalidation('{{ $productuuid[$key] }}','{{ $secondkey }}')"
                                                            wire:model.delay="inward.{{ $productuuid[$key] }}.{{ $secondkey }}.mrp"
                                                            class="form-control bg-white text-end" placeholder="mrp">
                                                        @error('inward.' . $productuuid[$key] . '.' . $secondkey .
                                                            '.mrp')
                                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="width: 10%">
                                                        <input type="selling_price"
                                                            wire:model.delay="inward.{{ $productuuid[$key] }}.{{ $secondkey }}.selling_price"
                                                            class="form-control bg-white text-end"
                                                            placeholder="selling_price">
                                                        @error('inward.' . $productuuid[$key] . '.' . $secondkey .
                                                            '.selling_price')
                                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format((float) $inward[$productuuid[$key]][$secondkey]['total'], 2, '.', '') }}
                                                    </td>
                                                    <td class="text-center" style="width:4%">
                                                        <button
                                                            {{ array_key_last($inward[$productuuid[$key]]) == $secondkey ? '' : 'hidden' }}
                                                            wire:click="addextcol('{{ $productuuid[$key] }}')">
                                                            <i class="bi bi-plus text-success"
                                                                style="font-size: 1.2rem;"></i>
                                                        </button>
                                                        <button
                                                            wire:click="subcol('{{ $productuuid[$key] }}', {{ $secondkey }})"
                                                            {{ $secondkey == 0 ? 'hidden' : '' }}>
                                                            <i class="bi bi-trash text-danger"
                                                                style="font-size: 1.2rem;"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center fw-bold">
                        No Records..
                    </div>
                @endif
            </div>
            <div class="card-body ms-auto w-50 m-3">
                <div class="d-flex">
                    <table class="table table-bordered table-light">
                        <tbody class="fs-5 text-warning">
                            <tr class="text-black">
                                <td class="fw-bold text-end">
                                    TAXABLE AMOUNT
                                </td>
                                <td class="text-end" style="width:50%">
                                    {{ number_format((float) $taxableamt, 2, '.', '') }}
                                </td>
                            </tr>
                            <tr class="text-black">
                                <td class="fw-bold text-end">
                                    CGST
                                </td>
                                <td class="text-end" style="width:50%">
                                    {{ number_format((float) $cgst, 2, '.', '') }}
                                </td>
                            </tr>
                            <tr class="text-black">
                                <td class="fw-bold text-end">
                                    SGST
                                </td>
                                <td class="text-end" style="width:50%">
                                    {{ number_format((float) $sgst, 2, '.', '') }}
                                </td>
                            </tr>
                            <tr class="text-black">
                                <td class="fw-bold text-end">
                                    TAX AMOUNT
                                </td>
                                <td class="text-end" style="width:50%">
                                    {{ number_format((float) $taxamt, 2, '.', '') }}
                                </td>
                            </tr>
                            <tr class="text-black">
                                <td class="fw-bold text-end">
                                    GRAND TOTAL
                                </td>
                                <td class="text-end" style="width:50%">
                                    {{ number_format((float) $grandtotal, 2, '.', '') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row g-3 p-3">
                @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'note',
                    'labelname' => 'NOTE',
                    'labelidname' => 'note',
                    'required' => false,
                    'col' => 'col-md-6',
                ])
            </div>
            <div class="text-center d-flex justify-content-center gap-2 align-items-center">
                <div wire:loading wire:target="store" class="mt-2">
                    <div class="spinner-border loadingspinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <button wire:click="store" class="btn theme_bg_color">Save</button>
                <button type="button" class="btn btn-secondary" wire:click="formreset">Cancel</button>
            </div>
        @endif
    </div>
</div>
