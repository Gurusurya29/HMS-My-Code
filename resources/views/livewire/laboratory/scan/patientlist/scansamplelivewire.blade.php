<div class="card">
    <div class="card-header theme_bg_color text-white">
        SCAN SAMPLE
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
                        <th class="w-25">INVESTIGATION NAME</th>
                        <th class="w-25">SCAN DONE</th>
                        <th class="w-50">NOTES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scanpatient->scanpatientlist->where('is_movedtobill', true) as $key => $eachscansample)
                        <tr>
                            <td class="{{ $eachscansample->is_sampletaken ? 'text-success' : '' }}">
                                {{ $key + 1 }}</td>
                            <td class="w-50 {{ $eachscansample->is_sampletaken ? 'text-success' : '' }} fs-5">
                                {{ $eachscansample->scaninvestigation_name }}</td>
                            <td class="w-25">
                                <div class="form-check form-switch form-switch-md d-flex justify-content-center">
                                    <input wire:click="marksampledone({{ $eachscansample->id }})"
                                        {{ $eachscansample->is_sampletaken ? 'checked' : '' }} class="form-check-input"
                                        type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </div>
                            </td>
                            <td class="w-25">
                                <div class="m-0 p-0">

                                    <textarea class="form-control " wire:model.debounce.150ms="sample_note.{{ $eachscansample->id }}" rows="1"></textarea>
                                </div>
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
