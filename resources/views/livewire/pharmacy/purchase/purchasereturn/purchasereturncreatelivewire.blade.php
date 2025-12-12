<div>
    <div class="bg-white p-2 shadow-sm">
        <div class="row g-2 p-3 w-75 mx-auto">
            <div class="col-md-12">
                @livewire('pharmacy.common.supplier.searchsupplierlivewire')
            </div>
            <div class="col-md-6">
                @livewire('pharmacy.common.pharmacyproduct.searchpharmacyproductlivewire', ['supplier_dependent' => true])
            </div>
            <div class="col-md-6">
                @livewire('pharmacy.common.pharmacyproductbatch.searchpharmacyproductbatchlivewire', ['supplier_dependent' => true])
            </div>
        </div>
        <div class="text-center" wire:loading wire:target="productdetails">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        @if (count($returnitems) > 0)
            <div class="mt-3">
                <div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered text-center text-primary table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">NAME</th>
                                        <th scope="col">BATCH NO.</th>
                                        <th scope="col">EXPIRY DATE</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">SOLD QTY</th>
                                        <th scope="col">CURRENT QTY</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-5 text-primary">
                                    @foreach ($returnitems as $key => $value)
                                        <tr class="text-black">
                                            <td class="fw-bold">
                                                {{ $returnproductname[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $returnbatch[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ Carbon\Carbon::parse($returnexpiry_date[$key])->format('d-m-Y') }}
                                            </td>
                                            <td class="fw-bold text-end">
                                                {{ $returnprice[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $soldquantity[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $returncurrentqt[$key] }}
                                            </td>
                                            <td style="width:10%;">
                                                <input wire:model="returnquantity.{{ $key }}" type="text"
                                                    class="form-control text-center fw-bolder bg-white"
                                                    placeholder="quantity">
                                                @error('returnquantity.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-center fw-bolder mt-auto p-2" style="width:5%">
                                                <button type="button" tabindex="-1"
                                                    wire:click="removeitem({{ $key }})">
                                                    <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row g-3 p-3 ">
                    @include('helper.formhelper.form', [
                        'type' => 'number',
                        'fieldname' => 'negotiated_price',
                        'labelname' => 'NEGOTIATED PRICE',
                        'labelidname' => 'negotiated_price',
                        'required' => true,
                        'col' => 'col-md-4',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'issue_note',
                        'labelname' => 'ISSUE NOTE',
                        'labelidname' => 'issue_note',
                        'required' => true,
                        'col' => 'col-md-4',
                    ])
                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'note',
                        'labelname' => 'NOTE',
                        'labelidname' => 'note',
                        'required' => false,
                        'col' => 'col-md-4',
                    ])
                </div>
                <div class="text-center d-flex justify-content-center gap-2 align-items-center">
                    <div wire:loading wire:target="store" class="mt-2">
                        <div class="spinner-border loadingspinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <button wire:click="store" class="btn theme_bg_color">Save</button>
                    <a href={{ route('pharmacy.purchasereturncreate') }} class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        @endif
    </div>
</div>
