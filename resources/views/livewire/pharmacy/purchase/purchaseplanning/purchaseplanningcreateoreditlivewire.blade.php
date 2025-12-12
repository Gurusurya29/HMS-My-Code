<div class="bg-white p-2 shadow-sm">
    <form wire:submit.prevent="store" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data"
        autocomplete="off">
        <div class="row g-2 p-3 w-50 mx-auto">
            <div class="col-md-6 position-relative">
                <label for="query" class="form-label">SUPPLIER COMPANY NAME</label>
                <span class="text-danger fw-bold">*</span>
                <input {{ $purchaseplanid ? 'readonly' : '' }} type="text" class="form-control" id="query"
                    placeholder="Search Supplier Company..." wire:model="query" wire:keydown.escape="resetData"
                    wire:keydown.arrow-up="decrementHighlight" wire:keydown.arrow-down="incrementHighlight"
                    wire:keydown.enter="selectSupplier" />
                @error('supplier_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @if (!empty($query))
                    <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
                    <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:96%">
                        @if ($issupplierselected === false)
                            @if (!empty($suppliers))
                                @foreach ($suppliers as $i => $supplier)
                                    <div type="button" wire:click='selecthissupplier({{ $supplier['id'] }})'
                                        class="search-option-list list-item p-1 text-sm {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                                        {{ $supplier['uniqid'] }} - {{ $supplier['company_name'] }} -
                                        {{ $supplier['contact_mobile_no'] }}</div>
                                @endforeach
                            @else
                                <div class="list-item p-1">No results!</div>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
            @if ($issupplierselected)
                @include('helper.formhelper.form', [
                    'type' => 'date',
                    'fieldname' => 'purchase_date',
                    'labelname' => 'REQUIRED DATE',
                    'labelidname' => 'purchase_date',
                    'required' => true,
                    'col' => 'col-md-6',
                ])
            @endif
        </div>
        <div class="justify-content-center mt-5" wire:loading wire:loading.class="d-flex"
            wire:target="selectSupplier, selecthissupplier">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        @if ($issupplierselected)
            @include('livewire.pharmacy.purchase.supplier.supplierdetail', [
                'supplier' => $supplier,
                'width' => 'col-md-8',
            ])
            {{-- Out of Stock --}}
            <div class="p-3">
                <div class="card shadow-sm mt-2">
                    <div class="card-header text-white customdanger">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">Out of Stock</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if (sizeof($stocklessproductid) > 0)
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered text-center text-danger table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">ITEM</th>
                                        <th scope="col">GENERIC <br>NAME</th>
                                        <th scope="col">MANUFACTURE <br>NAME</th>
                                        <th scope="col">CGST %</th>
                                        <th scope="col">CGST</th>
                                        <th scope="col">SGST %</th>
                                        <th scope="col">SGST</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">TOTAL</th>
                                        <th scope="col">GRAND</th>
                                        <th scope="col">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-5 text-danger">
                                    @foreach ($stocklessproductid as $key => $value)
                                        <tr class="text-black">
                                            <td class="fw-bold">
                                                {{ $stocklessproductname[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $stocklessproductgenaric[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $stocklessproductmanufacture[$key] }}
                                            </td>
                                            <td>
                                                {{ $stocklessproductcgst[$key] }}%
                                            </td>
                                            <td>
                                                {{ number_format((float) $stocklessproductcgstamt[$key], 2, '.', '') }}
                                            </td>
                                            <td>
                                                {{ $stocklessproductsgst[$key] }}%
                                            </td>
                                            <td>
                                                {{ number_format((float) $stocklessproductsgstamt[$key], 2, '.', '') }}
                                            </td>
                                            <td style="width:10%;">
                                                <input
                                                    wire:change="productlivevalidation('stockless','{{ $key }}')"
                                                    wire:keyup="productlivevalidation('stockless','{{ $key }}')"
                                                    wire:model.delay="stocklessproductprice.{{ $key }}"
                                                    type="text" class="form-control text-end fw-bolder bg-white"
                                                    placeholder="price">
                                                @error('stocklessproductprice.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="width:10%;">
                                                <input type="text" class="form-control bg-white text-center"
                                                    placeholder="quantity"
                                                    wire:change="productlivevalidation('stockless','{{ $key }}')"
                                                    wire:keyup="productlivevalidation('stockless','{{ $key }}')"
                                                    wire:model.delay="stocklessproductqunatity.{{ $key }}">
                                                @error('stocklessproductqunatity.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                                {{ number_format((float) ($stocklessproducttotal[$key] - $stocklessproductcgstamt[$key] - $stocklessproductsgstamt[$key]), 2, '.', '') }}
                                            </td>
                                            <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                                {{ number_format((float) $stocklessproducttotal[$key], 2, '.', '') }}
                                            </td>
                                            <td class="text-center fw-bolder mt-auto p-2" style="width:5%">
                                                <button type="button" tabindex="-1"
                                                    wire:click="removeitem('stockless',{{ $key }})">
                                                    <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="text-black">
                                        <td colspan="10" class="text-end fw-bold py-auto">
                                            TOTAL
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ number_format((float) collect($stocklessproducttotal)->sum(), 2, '.', '') }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2" style="width:5%">

                                        </td>
                                    </tr>
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
            {{-- About to be Out of Stock --}}
            <div class="p-3">
                <div class="card shadow-sm mt-2">
                    <div class="card-header text-white customwarning">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">About to be Out of
                                    Stock (Minimum Order Level)</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if (sizeof($abt2beproductid) > 0)
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered text-center text-warning table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">ITEM</th>
                                        <th scope="col">GENERIC <br>NAME</th>
                                        <th scope="col">MANUFACTURE <br>NAME</th>
                                        <th scope="col">MIN QTY</th>
                                        <th scope="col">CURRENT QTY</th>
                                        <th scope="col">CGST %</th>
                                        <th scope="col">CGST</th>
                                        <th scope="col">SGST %</th>
                                        <th scope="col">SGST</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">TOTAL</th>
                                        <th scope="col">GRAND</th>
                                        <th scope="col">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-5 text-warning">
                                    @foreach ($abt2beproductid as $key => $value)
                                        <tr class="text-black">
                                            <td class="fw-bold">
                                                {{ $abt2beproductname[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $abt2beproductgenaric[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $abt2beproductmanufacture[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $abt2beminstock[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $abt2beproductstock[$key] }}
                                            </td>
                                            <td>
                                                {{ $abt2beproductcgst[$key] }}%
                                            </td>
                                            <td>
                                                {{ number_format((float) $abt2beproductcgstamt[$key], 2, '.', '') }}
                                            </td>
                                            <td>
                                                {{ $abt2beproductsgst[$key] }}%
                                            </td>
                                            <td>
                                                {{ number_format((float) $abt2beproductsgstamt[$key], 2, '.', '') }}
                                            </td>
                                            <td style="width:10%;">
                                                <input type="text" class="form-control text-end fw-bolder bg-white"
                                                    placeholder="price"
                                                    wire:change="productlivevalidation('abt2be','{{ $key }}')"
                                                    wire:keyup="productlivevalidation('abt2be','{{ $key }}')"
                                                    wire:model.delay="abt2beproductprice.{{ $key }}">
                                                @error('abt2beproductprice.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style=" width:10%;"><input type="text"
                                                    class="form-control bg-white text-center fw-bolder"
                                                    placeholder="quantity"
                                                    wire:change="productlivevalidation('abt2be','{{ $key }}')"
                                                    wire:keyup="productlivevalidation('abt2be','{{ $key }}')"
                                                    wire:model.delay="abt2beproductqunatity.{{ $key }}">
                                                @error('abt2beproductqunatity.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                                {{ $abt2beproducttotal[$key] - $abt2beproductcgstamt[$key] - $abt2beproductsgstamt[$key] }}
                                            </td>
                                            <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                                {{ $abt2beproducttotal[$key] }}
                                            </td>
                                            <td class="text-center fw-bolder mt-auto p-2" style="width:5%">
                                                <button type="button" tabindex="-1"
                                                    wire:click="removeitem('abt2be',{{ $key }})">
                                                    <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="text-black">
                                        <td colspan="12" class="text-end fw-bold py-auto">
                                            TOTAL
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ collect($abt2beproducttotal)->sum() }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2" style="width:5%">

                                        </td>
                                    </tr>
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
            <div class="w-50 mx-auto">
                @php
                    $ar1 = collect($abt2beproductid)->toArray();
                    $ar2 = collect($stocklessproductid)->toArray();
                    $c = array_merge($ar1, $ar2);
                @endphp
                @livewire('pharmacy.common.pharmacyproduct.searchpharmacyproductlivewire', [
                    'supplier_id' => $supplier->id,
                    'ignoreids' => $c,
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
                        <div>
                            <table class="table table-bordered text-center text-primary table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">ITEM</th>
                                        <th scope="col">GENERIC <br>NAME</th>
                                        <th scope="col">MANUFACTURE <br>NAME</th>
                                        <th scope="col">CURRENT STOCK</th>
                                        <th scope="col">CGST %</th>
                                        <th scope="col">CGST</th>
                                        <th scope="col">SGST %</th>
                                        <th scope="col">SGST</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">TOTAL</th>
                                        <th scope="col">GRAND</th>
                                        <th scope="col">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-5 text-warning">
                                    @foreach ($extproductid as $key => $value)
                                        <tr class="text-black">
                                            <td class="fw-bold">
                                                {{ $extproductname[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $extproductgenaric[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $extproductmanufacture[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $extproductstock[$key] }}
                                            </td>
                                            <td>
                                                {{ $extproductcgst[$key] }}%
                                            </td>
                                            <td>
                                                {{ number_format((float) $extproductcgstamt[$key], 2, '.', '') }}
                                            </td>
                                            <td>
                                                {{ $extproductsgst[$key] }}%
                                            </td>
                                            <td>
                                                {{ number_format((float) $extproductsgstamt[$key], 2, '.', '') }}
                                            </td>
                                            <td style="width:10%;">
                                                <input type="text" class="form-control text-end fw-bolder bg-white"
                                                    placeholder="price"
                                                    wire:change="productlivevalidation('extproduct','{{ $key }}')"
                                                    wire:keyup="productlivevalidation('extproduct','{{ $key }}')"
                                                    wire:model.delay="extproductprice.{{ $key }}">
                                                @error('extproductprice.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style=" width:10%;"><input type="text"
                                                    class="form-control bg-white text-center fw-bolder"
                                                    placeholder="quantity"
                                                    wire:change="productlivevalidation('extproduct','{{ $key }}')"
                                                    wire:keyup="productlivevalidation('extproduct','{{ $key }}')"
                                                    wire:model.delay="extproductqunatity.{{ $key }}">
                                                @error('extproductqunatity.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                                {{ number_format((float) ($extproducttotal[$key] - $extproductcgstamt[$key] - $extproductsgstamt[$key]), 2, '.', '') }}
                                            </td>
                                            <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                                {{ number_format((float) $extproducttotal[$key], 2, '.', '') }}
                                            <td class="text-center fw-bolder mt-auto p-2" style="width:5%">
                                                <button type="button" tabindex="-1"
                                                    wire:click="removeitem('extproduct',{{ $key }})">
                                                    <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="text-black">
                                        <td colspan="11" class="text-end fw-bold py-auto">
                                            TOTAL
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ number_format((float) collect($extproducttotal)->sum(), 2, '.', '') }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2" style="width:5%">

                                        </td>
                                    </tr>
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
                                    {{ number_format(
                                        (float) (collect($stocklessproductcgstamt)->sum() +
                                            collect($abt2beproductcgstamt)->sum() +
                                            collect($extproductcgstamt)->sum()),
                                        2,
                                        '.',
                                        '',
                                    ) }}
                                </td>
                            </tr>
                            <tr class="text-black">
                                <td class="fw-bold text-end">
                                    SGST
                                </td>
                                <td class="text-end" style="width:50%">
                                    {{ number_format(
                                        (float) (collect($stocklessproductsgstamt)->sum() +
                                            collect($abt2beproductsgstamt)->sum() +
                                            collect($extproductsgstamt)->sum()),
                                        2,
                                        '.',
                                        '',
                                    ) }}
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
                @include('livewire.pharmacy.common.formsubmithelper.loader', [
                    'target' => 'store',
                ])
                <button type="submit" class="btn theme_bg_color">Save</button>
                <button type="button" class="btn btn-secondary" wire:click="formreset">Cancel</button>
            </div>
        @endif
    </form>
</div>
