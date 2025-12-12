<div class="card">
    <div class="card-header theme_bg_color text-white">
        LABORATORY DELIVERY
        <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('laboratorypatientlist') }}"
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
                        <th>LAB COUNT</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $labpatient->patient->uhid }}</th>
                        <td>{{ $labpatient->patient->name }}</td>
                        <td>{{ $labpatient->patient->phone }}</td>
                        <td>{{ $labpatient->patient->dob }}</td>
                        <td>{{ $labpatient->patient->email }}</td>
                        <td>{{ $labpatient->patient->aadharid }}</td>
                        <td>{{ $labpatient->labpatientlist()->count() }}</td>

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
                        <th class="w-25">DELIVERY</th>
                        <th class="w-50">NOTES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($labpatient->labpatientlist->where('is_resultupdated', true) as $key => $eachlabsample)
                        <tr>
                            <td class="{{ $eachlabsample->is_reportdelivered ? 'text-success' : '' }}">
                                {{ $key + 1 }}</td>
                            <td class="w-50 {{ $eachlabsample->is_reportdelivered ? 'text-success' : '' }} fs-5">
                                {{ $eachlabsample->labinvestigation_name }}</td>
                            <td class="w-25">
                                <div class="form-check form-switch form-switch-md d-flex justify-content-center">
                                    <input wire:click="markdeliverydone({{ $eachlabsample->id }})"
                                        {{ $eachlabsample->is_reportdelivered ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </div>
                            </td>
                            <td class="w-25">
                                <div class="m-0 p-0">

                                    <textarea class="form-control" wire:model.debounce.150ms="delivery_note.{{ $eachlabsample->id }}" rows="1"></textarea>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ route('laboratorypatientlist') }}" class="btn btn-success float-end">Save & Exit</a>
    </div>
</div>
