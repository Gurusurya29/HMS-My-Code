<div class="col-md-6">
    <div class="card">
        <div class="card-header theme_bg_color text-white fw-bold">
            ADD LAB INVESTIGATION
        </div>
        <div class="card-body">
            <div class="row g-2">
                <select wire:model="labinvestigation" id="labinvestigation" class="form-select labinvestigation-dropdown"
                    multiple>
                    @foreach ($labinvestigation_data as $eachlabinvestigation)
                        <option value="{{ $eachlabinvestigation->id }}">
                            {{ $eachlabinvestigation->name }}
                        </option>
                    @endforeach
                </select>
                @error('labinvestigation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @include('helper.formhelper.form', [
                    'type' => 'toggle',
                    'fieldname' => 'is_labinvestigationemergency',
                    'labelname' => 'IS EMERGENCY',
                    'labelidname' => 'is_labinvestigationemergencyid',
                    'required' => false,
                    'col' => 'col-md-4',
                ])
                @include('helper.formhelper.form', [
                    'type' => 'file',
                    'fieldname' => 'labinvestigation_file',
                    'labelname' => 'LAB FILE',
                    'labelidname' => 'labinvestigation_fileid',
                    'required' => false,
                    'col' => 'col-md-8',
                    'is_uploaded' => $templabinvestigation_file ? true : false,
                ])
                @include('helper.formhelper.form', [
                    'type' => 'textarea',
                    'fieldname' => 'labinvestigation_note',
                    'labelname' => '',
                    'placeholder' => 'LAB INVESTIGATION NOTE',
                    'labelidname' => 'labinvestigation_noteid',
                    'required' => false,
                    'col' => 'col-md-12',
                ])
            </div>
        </div>
    </div>
</div>
