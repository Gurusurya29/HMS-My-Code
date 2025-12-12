<div class="col-md-12">
    <div class="card">
        <div class="card-header theme_bg_color text-white fw-bold">
            R<sub class="fs-6">x</sub> - ADD PRESCRIPTION
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="position-relative">
    <input
        type="text"
        class="form-control shadow-sm"
        placeholder="Search Drug..."
        wire:model.debounce.200ms="searchquery"
        autocomplete="off"
    >

    <!-- SEARCHING... -->
    <ul class="list-group position-absolute w-100 mt-1 shadow"
        style="z-index: 9999;"
        wire:loading
        wire:target="searchquery">
        <li class="list-group-item">Searching...</li>
    </ul>

    <!-- RESULTS -->
    @if(!empty($searchquery))
        <ul class="list-group position-absolute w-100 mt-1 shadow bg-white"
            style="max-height: 250px; overflow-y: auto; z-index: 9999;"
            wire:loading.remove
            wire:target="searchquery">

            @forelse($pharmacyproduct as $each)
                <li class="list-group-item list-group-item-action"
                    wire:click="additem({{ $each['id'] }})">
                    <div class="d-flex justify-content-between">
                        <span>{{ $each['name'] }}</span>
                        <span class="badge bg-primary">SKU: {{ $each['product_sku'] }}</span>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No results found.</li>
            @endforelse
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
                                <button wire:click.prevent="removeitem({{ $key }})"
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
                'type' => 'toggle',
                'fieldname' => 'is_prescriptionemergency',
                'labelname' => 'IS EMERGENCY',
                'labelidname' => 'is_prescriptionemergencyid',
                'required' => false,
                'col' => 'col-md-2',
                ])
                @include('helper.formhelper.form', [
                'type' => 'file',
                'fieldname' => 'prescription_file',
                'labelname' => 'PRESCRIPTION FILE',
                'labelidname' => 'prescription_fileid',
                'required' => false,
                'col' => 'col-md-4',
                'is_uploaded' => $tempprescription_file ? true : false,
                ])
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