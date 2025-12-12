<div class="card">
    <div class="card-header theme_bg_color text-white">
        LABORATORY DELIVERY
        <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('xraypatientlist') }}"
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
                        <th>XRAY COUNT</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $xraypatient->patient->uhid }}</th>
                        <td>{{ $xraypatient->patient->name }}</td>
                        <td>{{ $xraypatient->patient->phone }}</td>
                        <td>{{ $xraypatient->patient->dob }}</td>
                        <td>{{ $xraypatient->patient->email }}</td>
                        <td>{{ $xraypatient->patient->aadharid }}</td>
                        <td>{{ $xraypatient->xraypatientlist()->count() }}</td>

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
                        <th class="w-25">X-RAY DELIVERY</th>
                        <th class="w-50">NOTES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($xraypatient->xraypatientlist->where('is_resultupdated', true) as $key => $eachxraysample)
                        <tr>
                            <td class="{{ $eachxraysample->is_reportdelivered ? 'text-success' : '' }}">
                                {{ $key + 1 }}</td>
                            <td class="w-50 {{ $eachxraysample->is_reportdelivered ? 'text-success' : '' }} fs-5">
                                {{ $eachxraysample->xrayinvestigation_name }}</td>
                            <td class="w-25">
                                <div class="form-check form-switch form-switch-md d-flex justify-content-center">
                                    <input wire:click="markdeliverydone({{ $eachxraysample->id }})"
                                        {{ $eachxraysample->is_reportdelivered ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </div>
                            </td>
                            <td class="w-25">
                                <div class="m-0 p-0">

                                    <textarea class="form-control " wire:model.debounce.150ms="delivery_note.{{ $eachxraysample->id }}" rows="1"></textarea>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('xraypatientlist') }}" class="btn btn-success float-end">Save & Exit</a>
    </div>
</div>
