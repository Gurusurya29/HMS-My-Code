<div class="card">
    <div class="card-header theme_bg_color text-white">
        MOVE TO BILL
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
                        <td>{{ $scanpatient->patient->dob ? date('d-m-Y', strtotime($scanpatient->patient->dob)) : '-' }}
                        </td>
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
                        <th class="">INVESTIGATION NAME</th>
                        <th class="">FEE</th>
                        <th class="w-25">MOVE TO BILL </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scanpatient->scanpatientlist as $key => $eachscanmovetobill)
                        <tr>
                            <td class="{{ $eachscanmovetobill->is_movedtobill ? 'text-success' : '' }}">
                                {{ $key + 1 }}</td>
                            <td class=" {{ $eachscanmovetobill->is_movedtobill ? 'text-success' : '' }} fs-5">
                                {{ $eachscanmovetobill->scaninvestigation_name }}</td>
                            <td class="">{{ $eachscanmovetobill->fee }}</td>
                            <td class="">
                                <div class="form-check form-switch form-switch-md d-flex justify-content-center">
                                    <input wire:click="markmovedtobill({{ $eachscanmovetobill->id }})"
                                        {{ $eachscanmovetobill->is_movedtobill ? 'checked' : '' }}
                                        class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    <tr class="text-start fs-5">
                        <td colspan="3" class="text-end fw-bold">
                            <div>Total</div>
                            <div>Selected Investigation Total</div>
                            <div>Discount(%)</div>
                            <div>Grand Total</div>
                        </td>
                        <td>
                            <div>{{ $scanpatient->scanpatientlist->sum('fee') }}</div>
                            <div>{{ $selectedtotalscancost }}</div>
                            <div>

                                <input wire:model.debounce.150ms="discount_percentage" id="discount_percentage"
                                    type="number"class="form-control w-25">
                                @error('discount_percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div>{{ $grand_total }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        <button wire:click="saveandexit" class="btn btn-success float-end">Save & Exit</button>
        {{-- <a href="{{ route('scanoratorypatientlist') }}" class="btn btn-success float-end">Save & Exit</a> --}}
    </div>
</div>
