<div class="col-md-12">
    <div class="card">
        <div class="card-header theme_bg_color text-white fw-bold">
            R<sub class="fs-6">x</sub> ADVICE
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="dropdown">
                    <input type="text" class="form-control shadow-sm" placeholder="Search Drug..."
                        wire:model="searchquery"   wire:model.live.debounce.300ms="searchquery" />

                      <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                        <li class="ist-group-item d-flex justify-content-between align-items-center">
                            Searching...</li>
                    </ul>

                    @if (!empty($searchquery))
                        <ul class="dropdown-menu list-group w-100 p-0 bg-gray shadow-sm">
                            @if (!empty($pharmacyproduct))
                                @foreach ($pharmacyproduct as $i => $eachpharmacyproduct)
                                    <li wire:click="addprescription({{ $eachpharmacyproduct['id'] }})"
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <h6> {{ $eachpharmacyproduct['name'] }} </h6>

                                        <h5>
                                            <span class=" badge bg-primary rounded-pill">SKU:
                                                {{ $eachpharmacyproduct['product_sku'] }}</span>
                                        </h5>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    No results!
                                    <span class="badge bg-primary rounded-pill">0</span>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
                <table class="table table-bordered shadow-sm  text-center">
                    <thead class="fw-bold table-primary" style="font-size: 14px;">
                        <tr>
                            <th style="width: 25%;">DRUG</th>
                            <th style="width: 10%;">MORNING</th>
                            <th style="width: 10%;">AFTERNOON</th>
                            <th style="width: 10%;">EVENING</th>
                            <th style="width: 10%;">NIGHT</th>
                            <th style="width: 10%;">BF</th>
                            <th style="width: 10%;">AF</th>
                            <th style="width: 10%;">COUNT</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($prescriptionlist)
                            @foreach ($prescriptionlist as $key => $eachprescriptionlist)
                                <tr>
                                    <td>
                                        <span class="timesfont fw-bold">
                                            {{ $eachprescriptionlist['drug_name'] }}</span>
                                    </td>
                                    <th>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.lazy="prescriptionlist.{{ $key }}.morning">
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.lazy="prescriptionlist.{{ $key }}.afternoon">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.lazy="prescriptionlist.{{ $key }}.evening">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.lazy="prescriptionlist.{{ $key }}.night">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.lazy="prescriptionlist.{{ $key }}.before_food">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch py-0 m-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                wire:model.lazy="prescriptionlist.{{ $key }}.after_food">
                                        </div>
                                    </td>
                                    <td style="width:90px;">
                                        <input type="text" class="form-control form-control-sm"
                                            wire:model.lazy="prescriptionlist.{{ $key }}.count">
                                        @error('prescriptionlist.' . $key . '.count')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <button wire:click.prevent="removelineitem({{ $key }},'prescription')"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i> </button>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">No prescription added</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'prescription_note',
                    'labelname' => '',
                    'placeholder' => 'PRESCRIPTION NOTE',
                    'labelidname' => 'prescription_noteid',
                    'required' => false,
                    'col' => 'col-md-6',
                ])
            </div>
        </div>
    </div>
</div>
