<div class="card">
    <div class="card-header theme_bg_color text-white">
        LABORATORY REPORT
        <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('scanpatientlist') }}"
            role="button">Back</a>
    </div>
    <div class="card-body">
        <div class="table-responsive shadow-sm mb-2">
            <table class="table table-bordered table-success p-0 m-0 text-center">
                <thead class="georgiafont">
                    <tr>
                        <th>UHID</th>
                        <th>NAME</th>
                        <th>PHONE</th>
                        <th>DOB</th>
                        <th>EMAIL</th>
                        <th>AADHAR</th>
                        <th>SCAN COUNT</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $scanpatient->patient->uhid }}</th>
                        <td>{{ $scanpatient->patient->name }}</td>
                        <td>{{ $scanpatient->patient->phone }}</td>
                        <td>{{ $scanpatient->patient->dob }}</td>
                        <td>{{ $scanpatient->patient->email }}</td>
                        <td>{{ $scanpatient->patient->aadharid }}</td>
                        <td>{{ $scanpatient->scanpatientlist()->count() }}</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive shadow-sm mb-2">
            <table class="table table-bordered  p-0 m-0 text-center">
                <thead class="theme_bg_color text-white">
                    <tr>
                        <th>S.NO</th>
                        <th>INVESTIGATION NAME</th>
                        {{-- <th>RESULT VALUE</th> --}}
                        <th>UPDATE RESULT</th>
                        <th>UPLOAD IMAGE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scanpatient->scanpatientlist->where('is_sampletaken', true) as $key => $eachscanreport)
                        <tr class="table-info">
                            <td class="fs-5 {{ $eachscanreport->is_resultupdated ? 'text-success' : '' }}">
                                {{ $key + 1 }}</td>
                            <td class="w-50 fs-5 {{ $eachscanreport->is_resultupdated ? 'text-success' : '' }}">
                                {{ $eachscanreport->scaninvestigation_name }}</td>

                            {{-- <td class="w-25">

                                <textarea class="form-control" wire:model.debounce.150ms="result_note.{{ $eachscanreport->id }}" rows="1"></textarea>

                            </td> --}}
                            <td class="w-25">
                                <div class="form-check form-switch form-switch-md d-flex justify-content-center">
                                    <input wire:click="markreportdone({{ $eachscanreport->id }})"
                                        {{ $eachscanreport->is_resultupdated ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </div>
                            </td>
                            <td class="align-middle">
                                <form wire:submit.prevent="imagestore({{ $eachscanreport->id }})"
                                    enctype="multipart/form-data" class="d-flex g-2">
                                    <div class="col-md-8">
                                        <input wire:model="scan_image.{{ $eachscanreport->id }}" type="file"
                                            class="form-control form-control-sm {{ $eachscanreport->scan_image ? 'is-valid' : '' }}"
                                            id="scanimageid_{{ $eachscanreport->id }}">
                                        @error('scan_image.' . $eachscanreport->id)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </form>
                        </tr>
                        <tr>

                            <td wire:ignore scope="row" colspan="4" class="w-100">
                                <h5 class="float-start"> RESULT VALUE </h5>
                                <span class="clearfix"></span>
                                <textarea id="resultnoteid_{{ $eachscanreport->id }}" class="form-control"
                                    wire:model.debounce.150ms="result_note.{{ $eachscanreport->id }}" rows="4"></textarea>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('scanpatientlist') }}" class="btn btn-success float-end">Save & Exit</a>
    </div>
</div>

@push('scripts')
    <script>
        array = {!! $scanpatient->scanpatientlist->where('is_sampletaken', true)->pluck('id') !!};
        $(function() {
            array.forEach(element => {
                ClassicEditor
                    .create(document.querySelector('#resultnoteid_' + element))
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('result_note.' + element, editor.getData());
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>

    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
@endpush
