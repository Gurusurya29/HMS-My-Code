<div class="mb-6">
    <div class="bg-white p-2 shadow-sm">
        <form autocomplete="off">
            <div class="row g-3 p-3">
                <div class="{{ $patient_uhid ? 'col-md-2' : 'col-md-4' }} position-relative">
                    <label for="patient" class="form-label">ADD / Search Customer UHID/ Name / Mobile No.</label>
                    <span class="text-danger fw-bold">*</span>
                    <input autocomplete="off" type="text" class="form-control" id="patient"
                           placeholder="Search Patient ..." wire:model="patient" wire:keydown.escape="resetData"
                           wire:keydown.arrow-up=" decrementHighlight" wire:keydown.arrow-down="incrementHighlight"
                           wire:keydown.enter="selectPatient" {{ $prescription ? 'readonly' : '' }} />
                    @if (!empty($patient))
                        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
                        <div class="position-absolute bg-white rounded-t-none shadow-lg list-group"
                             style="width:97%; z-index: 50;">
                            @if ($ispatientselected === false)
                                @foreach ($pharmacypatientlist as $i => $eachpharmacypatient)
                                    <div type="button"
                                         wire:click='selecthispatient({{ $eachpharmacypatient->id }},{{ "'" . $eachpharmacypatient->phone . "'" }},{{ "'" . $eachpharmacypatient->uhid . "'" }},{{ "'" . $eachpharmacypatient->name . "'" }})'
                                         class="search-option-list list-item p-1 text-xs {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                                        {{ $eachpharmacypatient->phone }} - {{ $eachpharmacypatient->uhid }} -
                                        {{ $eachpharmacypatient->name }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    @error('patient')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if ($patient_uhid)
                    @include('helper.formhelper.form', [
                        'type' => 'text',
                        'fieldname' => 'patient_uhid',
                        'labelname' => 'CUSTOMER UHID',
                        'labelidname' => 'patient_uhid',
                        'required' => false,
                        'readonly' => true,
                        'col' => 'col-md-2',
                    ])
                @endif
                @include('helper.formhelper.form', [
                    'type' => 'text',
                    'fieldname' => 'patient_name',
                    'labelname' => 'CUSTOMER NAME',
                    'labelidname' => 'patient_name',
                    'required' => true,
                    'col' => $patient_uhid ? 'col-md-2' : 'col-md-4',
                ])
                @if ($patient_uhid)
                    <div class="col-md-2">
                        @livewire('pharmacy.sales.salesentry.searchprescriptionlivewire', [
                            'patient_id' => $patient_id,
                            'selected' => $patientalreadyselected,
                        ])
                    </div>
                @endif
                <div class="col-md-4 position-relative">
                    <label for="doctor" class="form-label">DOCTOR NAME</label>
                    <span class="text-danger fw-bold">*</span>
                    <input autocomplete="off" type="text" class="form-control" id="doctor"
                           placeholder="Search Doctor ..." wire:model="doctor" wire:keydown.escape="resetData"
                           wire:keydown.arrow-up=" docdecrementHighlight" wire:keydown.arrow-down="docincrementHighlight"
                           wire:keydown.enter="selectDoctor" />
                    @if (!empty($doctor))
                        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
                        <div class="position-absolute bg-white rounded-t-none shadow-lg list-group"
                             style="width:99%; z-index: 50;">
                            @if ($isdoctorselected === false)
                                @foreach ($pharmacydoctorlist as $i => $eachpharmacydoctor)
                                    <div type="button"
                                         wire:click='selecthisdoctor({{ $eachpharmacydoctor->id }},{{ "'" . $eachpharmacydoctor->name . "'" }})'
                                         class="search-option-list list-item p-1 text-xs {{ $dochighlightIndex === $i ? 'theme_bg_color' : '' }}">
                                        {{ $eachpharmacydoctor->name }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    @error('doctor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </form>
    </div>
    @if ($prescription)
        <div class="bg-white p-2 shadow-sm mt-3">
            <div>
                <div class="card-body">
                    <div>
                        <table class="table table-bordered text-center text-primary table-light">
                            <thead>
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">ALTERNATIVE</th>
                                    <th scope="col">MORNING</th>
                                    <th scope="col">AFTERNOON</th>
                                    <th scope="col">EVENING</th>
                                    <th scope="col">NIGHT</th>
                                    <th scope="col">AF</th>
                                    <th scope="col">BF</th>
                                    <th scope="col">COUNT</th>
                                </tr>
                            </thead>
                            <tbody class="fs-5 text-primary">
                                @foreach ($selectedprescription->prescriptionlist as $value)
                                    <tr class="text-black">
                                        <td class="fw-bold">
                                            {{ $value->drug_name }}
                                        </td>
                                        <td class="fw-bold" style="width: 40%;">
                                            @php
                                                $altproduct = $value->pharmacyproduct->alternativepharmacyproduct;
                                            @endphp
                                            @if (count($altproduct) > 0)
                                                @foreach ($altproduct as $key => $altvalue)
                                                    @if ($key != count($altproduct) - 1)
                                                        {{ $altvalue->alternativepharmacyproduct->name . ', ' }}
                                                    @else
                                                        {{ $altvalue->alternativepharmacyproduct->name }}
                                                    @endif
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            @if ($value->morning)
                                                <i class="bi bi-circle-fill" style="color:#00b600"></i>
                                            @else
                                                {{-- <i class="bi bi-circle-fill" style="color:#ff0000"></i> --}}
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            @if ($value->afternoon)
                                                <i class="bi bi-circle-fill" style="color:#00b600"></i>
                                            @else
                                                {{-- <i class="bi bi-circle-fill" style="color:#ff0000"></i> --}}
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            @if ($value->evening)
                                                <i class="bi bi-circle-fill" style="color:#00b600"></i>
                                            @else
                                                {{-- <i class="bi bi-circle-fill" style="color:#ff0000"></i> --}}
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            @if ($value->night)
                                                <i class="bi bi-circle-fill" style="color:#00b600"></i>
                                            @else
                                                {{-- <i class="bi bi-circle-fill" style="color:#ff0000"></i> --}}
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            @if ($value->after_food)
                                                <i class="bi bi-circle-fill" style="color:#00b600"></i>
                                            @else
                                                {{-- <i class="bi bi-circle-fill" style="color:#ff0000"></i> --}}
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            @if ($value->before_food)
                                                <i class="bi bi-circle-fill" style="color:#00b600"></i>
                                            @else
                                                {{-- <i class="bi bi-circle-fill" style="color:#ff0000"></i> --}}
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            {{ $value->count }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="bg-white p-2 shadow-sm mt-3">
        <div class="row g-2 p-3 w-75 mx-auto">
            <div class="col-md-4">
                @livewire('pharmacy.common.pharmacyproduct.searchpharmacyproductlivewire')
                @error('pharmproductid')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                @livewire('pharmacy.common.pharmacyproductbatch.searchpharmacyproductbatchlivewire', ['type' => 'sales'])
                @error('batchid')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="quantity" class="form-label">SALE QUANTITY</label>
                <span class="text-danger fw-bold">*</span>
                <input wire:keydown.enter="addproduct" wire:model.lazy="quantity" type="text" class="form-control"
                       id="quantity">
                @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-1">
                <div class=" mt-4">
                    <button wire:click="addproduct" class="btn btn-success btn-sm py-1 mt-2"
                            style="width:100px;">ADD</button>
                </div>
            </div>
        </div>
        <div class="justify-content-center mt-5" wire:loading wire:loading.class="d-flex" wire:target="addproduct">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        @if (sizeof($items) > 0)
            <form wire:submit.prevent="savesalesentry" onkeydown="return event.key != 'Enter';"
                  enctype="multipart/form-data" autocomplete="off">
                <div>
                    <div class="card-body">
                        <div>
                            <table class="table table-bordered text-center text-primary table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">NAME</th>
                                        <th scope="col">BATCH NO.</th>
                                        <th scope="col">EXP DATE</th>
                                        <th scope="col">CGST %</th>
                                        <th scope="col">CGST <br>AMT</th>
                                        <th scope="col">SGST %</th>
                                        <th scope="col">SGST <br>AMT</th>
                                        <th scope="col">SELLING ₹</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">DISC %</th>
                                        <th scope="col">TAXABLE <br>AMT</th>
                                        <th scope="col">TOTAL</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-5 text-primary">
                                    @foreach ($items as $key => $value)
                                        <tr class="text-black">
                                            <td class="fw-bold">
                                                {{ $name[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $batch[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ Carbon\Carbon::parse($expiry_date[$key])->format('d-m-Y') }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $cgst[$key] }}%
                                            </td>
                                            <td class="fw-bold">
                                                {{ $cgstamt[$key] }}
                                            </td>
                                            <td class="fw-bold">
                                                {{ $sgst[$key] }}%
                                            </td>
                                            <td class="fw-bold">
                                                {{ $sgstamt[$key] }}
                                            </td>
                                            <td style="width:6%;">
                                                <input wire:change="productlivevalidation({{ $key }})"
                                                       wire:keyup="productlivevalidation({{ $key }})"
                                                       wire:model="selling_price.{{ $key }}" type="text"
                                                       class="form-control text-end fw-bolder bg-white"
                                                       placeholder="price">
                                                @error('selling_price.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="width:6%;">
                                                <input type="text" class="form-control bg-white text-center"
                                                       placeholder="quantity"
                                                       wire:change="productlivevalidation({{ $key }})"
                                                       wire:keyup="productlivevalidation({{ $key }})"
                                                       wire:model="amount.{{ $key }}">
                                                @error('amount.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="width:6%;">
                                                <input type="text" class="form-control bg-white text-center"
                                                       placeholder="discound"
                                                       wire:change="productlivevalidation({{ $key }})"
                                                       wire:keyup="productlivevalidation({{ $key }})"
                                                       wire:model="disc.{{ $key }}">
                                                @error('disc.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            {{-- <td class="fw-bold text-end">
                                                {{ $disc_amt[$key] }}
                                            </td> --}}
                                            <td class="fw-bold text-end">
                                                {{ number_format((float) $taxable[$key], 2, '.', '') }}
                                            </td>
                                            <td class="fw-bold text-end">
                                                {{ number_format((float) $total[$key], 2, '.', '') }}
                                            </td>
                                            <td class="text-center fw-bolder mt-auto p-2" style="width:5%">
                                                <button type="button" tabindex="-1"
                                                        wire:click="removeitem({{ $key }})">
                                                    <i class="bi bi-trash text-danger" style="font-size: 1.2rem;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="text-black">
                                        <td colspan="11" class="text-end fw-bold py-auto">
                                            TOTAL DISC AMT
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ number_format((float) collect($disc_amt)->sum(), 2, '.', '') }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2">
                                        </td>
                                    </tr>
                                    <tr class="text-black">
                                        <td colspan="11" class="text-end fw-bold py-auto">
                                            TOTAL TAXABLE AMT
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ number_format((float) $taxableamt, 2, '.', '') }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2">
                                        </td>
                                    </tr>
                                    <tr class="text-black">
                                        <td colspan="11" class="text-end fw-bold py-auto">
                                            CGST
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ number_format((float) collect($cgstamt)->sum(), 2, '.', '') }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2">
                                        </td>
                                    </tr>
                                    <tr class="text-black">
                                        <td colspan="11" class="text-end fw-bold py-auto">
                                            SGST
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ number_format((float) collect($sgstamt)->sum(), 2, '.', '') }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2">
                                        </td>
                                    </tr>
                                    <tr class="text-black">
                                        <td colspan="11" class="text-end fw-bold py-auto">
                                            TOTAL TAX AMOUNT
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ number_format((float) $taxamt, 2, '.', '') }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2">
                                        </td>
                                    </tr>
                                    <tr class="text-black">
                                        <td colspan="11" class="text-end fw-bold py-auto">
                                            GRAND TOTAL
                                        </td>
                                        <td class="text-end fw-bolder mt-auto p-2" style="width:10%">
                                            {{ $grandtotal }}
                                        </td>
                                        <td class="text-center fw-bolder mt-auto p-2">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center d-flex justify-content-center gap-2 align-items-center mt-2">
                    <div wire:loading wire:target="savesalesentry" class="mt-2">
                        <div class="spinner-border loadingspinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <button type="submit" class="btn theme_bg_color">Save</button>
                    <button type="button" class="btn btn-secondary" wire:click="formreset">Cancel</button>
                </div>
            </form>
        @endif
    </div>
</div>
