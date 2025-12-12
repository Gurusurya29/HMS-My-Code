<div>
    <div class="bg-white p-2 shadow-sm">
        <div class="row g-2 p-3 w-75 mx-auto">
            <div class="col-md-6">
                @livewire('pharmacy.common.patient.searchpatientlivewire')
            </div>
            <div class="col-md-6 position-relative">
                <label for="sale" class="form-label">BILL NUMBER</label>
                <span class="text-danger fw-bold">*</span>
                <input autocomplete="off" type="text" class="form-control" id="sale"
                    placeholder="Search Bill Number ..." wire:model="sale" wire:keydown.escape="resetData"
                    wire:keydown.arrow-up=" decrementHighlight" wire:keydown.arrow-down="incrementHighlight"
                    wire:keydown.enter="selectSale" />
                @if (!empty($sale))
                    <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
                    <div class="position-absolute bg-white rounded-t-none shadow-lg list-group"
                        style="width:99%; z-index: 50;">
                        @if ($issaleselected === false)
                            @if (!empty($salelist))
                                @foreach ($salelist as $i => $eachsale)
                                    <div type="button"
                                        wire:click='selecthissale({{ $eachsale->id }},{{ "'" . $eachsale->uniqid . "'" }})'
                                        class="search-option-list list-item p-1 text-xs {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                                        {{ $eachsale->uniqid }}
                                    </div>
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
            wire:target="loadsalesitems, selecthissale">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        @if (sizeof($salesproductid) > 0)
            <div>
                <div class="card-body">
                    <div>
                        <table class="table table-bordered text-center text-primary table-light">
                            <thead>
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">BATCH NO.</th>
                                    <th scope="col">EXPIRY DATE</th>
                                    <th scope="col">SELLING PRICE</th>
                                    <th scope="col">SOLD QTY</th>
                                    <th scope="col">RETURN QTY</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">SELECT</th>
                                </tr>
                            </thead>
                            <tbody class="fs-5 text-primary">
                                @foreach ($salesproductid as $key => $value)
                                    <tr class="text-black">
                                        <td class="fw-bold">
                                            {{ $salesproductname[$key] }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ $salesbatch[$key] }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ $salesexpiry_date[$key] }}
                                        </td>
                                        <td class="fw-bold text-end">
                                            {{ $salesselling_price[$key] }}
                                        </td>
                                        <td class="fw-bold text-end">
                                            {{ $soldquantity[$key] }}
                                        </td>
                                        <td class="fw-bold text-end">
                                            {{ $returnqty[$key] }}
                                        </td>
                                        <td style="width:10%;">
                                            <input wire:model="returnquantity.{{ $key }}" type="text"
                                                class="form-control text-center fw-bolder bg-white"
                                                placeholder="quantity">
                                            @error('returnquantity.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            @if ($eligibleto_select[$key])
                                                <div class="form-check">
                                                    <input class="form-check-input mx-auto"
                                                        wire:model="is_selected.{{ $key }}" type="checkbox"
                                                        id="flexCheckDefault">
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- <tr class="text-black">
                                    <td colspan="5" class="text-end fw-bold py-auto">
                                        GRAND TOTAL
                                    </td>
                                    <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                        {{ collect($total)->sum() }}
                                    </td>
                                    <td class="text-center fw-bolder mt-auto p-2" style="width:5%">
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <form wire:submit.prevent="createsalesreturn" enctype="multipart/form-data" autocomplete="off">
                    <div class="row g-3 p-3 d-flex flex-row-reverse">
                        @include('helper.formhelper.form', [
                            'type' => 'toggle',
                            'fieldname' => 'batch_verified',
                            'labelname' => 'BATCH VERIFIED',
                            'labelidname' => 'batch_verified',
                            'required' => true,
                            'col' => 'col-md-2',
                        ])
                    </div>
                    <div class="row g-3 p-3">
                        @include('helper.formhelper.form', [
                            'type' => 'textarea',
                            'fieldname' => 'return_note',
                            'labelname' => 'RETURN NOTE',
                            'labelidname' => 'return_note',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                        @include('helper.formhelper.form', [
                            'type' => 'number',
                            'fieldname' => 'debit_amount',
                            'labelname' => 'DEBIT AMOUNT',
                            'labelidname' => 'debit_amount',
                            'required' => true,
                            'col' => 'col-md-4',
                        ])
                    </div>
                    <div class="text-center d-flex justify-content-center gap-2 align-items-center">
                        <div wire:loading wire:target="createsalesreturn" class="mt-2">
                            <div class="spinner-border loadingspinner" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <button type="submit" class="btn theme_bg_color">Save</button>
                        <a href={{ route('pharmacy.purchasereturncreate') }} class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
