<div class="col-md-6">
    <div class="card">
        <div class="card-header theme_bg_color text-white fw-bold">
            ADD X-RAY INVESTIGATION
        </div>
        <div class="card-body">
            <div class="row g-2">
                <select wire:model="xrayinvestigation" id="xrayinvestigation"
                    class="form-select xrayinvestigation-dropdown" multiple>
                    @foreach ($xrayinvestigation_data as $eachxrayinvestigation)
                        <option value="{{ $eachxrayinvestigation->id }}">
                            {{ $eachxrayinvestigation->name }}
                        </option>
                    @endforeach
                </select>
                @error('xrayinvestigation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @include('helper.formhelper.form', [
                    'type' => 'toggle',
                    'fieldname' => 'is_xrayinvestigationemergency',
                    'labelname' => 'IS EMERGENCY',
                    'labelidname' => 'is_xrayinvestigationemergencyid',
                    'required' => false,
                    'col' => 'col-md-4',
                ])

                @include('helper.formhelper.form', [
                    'type' => 'file',
                    'fieldname' => 'xrayinvestigation_file',
                    'labelname' => 'X-RAY FILE',
                    'labelidname' => 'xrayinvestigation_fileid',
                    'required' => false,
                    'col' => 'col-md-8',
                    'is_uploaded' => $tempxrayinvestigation_file ? true : false,
                ])

                @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'xrayinvestigation_note',
                    'labelname' => '',
                    'placeholder' => 'X-RAY INVESTIGATION NOTE',
                    'labelidname' => 'xrayinvestigation_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                ])
            </div>
        </div>
    </div>
</div>
