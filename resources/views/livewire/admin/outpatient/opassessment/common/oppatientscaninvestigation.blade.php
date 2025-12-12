<div class="col-md-6">
    <div class="card">
        <div class="card-header theme_bg_color text-white fw-bold">
            ADD SCAN INVESTIGATION
        </div>
        <div class="card-body">
            <div class="row g-2">
                <select wire:model="scaninvestigation" id="scaninvestigation"
                    class="form-select scaninvestigation-dropdown" multiple>
                    @foreach ($scaninvestigation_data as $eachscaninvestigation)
                        <option value="{{ $eachscaninvestigation->id }}">
                            {{ $eachscaninvestigation->name }}
                        </option>
                    @endforeach
                </select>
                @error('scaninvestigation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @include('helper.formhelper.form', [
                    'type' => 'toggle',
                    'fieldname' => 'is_scaninvestigationemergency',
                    'labelname' => 'IS EMERGENCY',
                    'labelidname' => 'is_scaninvestigationemergencyid',
                    'required' => false,
                    'col' => 'col-md-4',
                ])
                @include('helper.formhelper.form', [
                    'type' => 'file',
                    'fieldname' => 'scaninvestigation_file',
                    'labelname' => 'SCAN FILE',
                    'labelidname' => 'scaninvestigation_fileid',
                    'required' => false,
                    'col' => 'col-md-8',
                    'is_uploaded' => $tempscaninvestigation_file ? true : false,
                ])
                @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'scaninvestigation_note',
                    'labelname' => '',
                    'placeholder' => 'SCAN INVESTIGATION NOTE',
                    'labelidname' => 'scaninvestigation_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                ])
            </div>
        </div>
    </div>
</div>
