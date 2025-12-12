<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">DOCTOR/SPECIALITY WISE OP VISIT
                        REPORT</span>
                </div>
                <div class="bd-highlight d-flex gap-1">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('adminreports') }}"
                        role="button">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="p-3">
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        <div class="row justify-content-center">

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="startdateid" class="form-label fw-bold fs-6">From Date </label>
                                    <input type="date" wire:model="from_date" class="form-control form-control-sm"
                                        id="startdateid">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="enddateid" class="form-label fw-bold fs-6">To Date </label>
                                    <input type="date" wire:model="to_date" class="form-control form-control-sm"
                                        id="enddateid">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="doctorid" class="form-label fw-bold fs-6">Doctor </label>
                                    <select wire:model.lazy="doctor_id" class="form-select form-select-sm"
                                        id="doctorid">
                                        <option value>Select Doctor</option>
                                        @foreach ($doctor_data as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="doctorspecializationid" class="form-label fw-bold fs-6">Specialization
                                    </label>
                                    <select wire:model.lazy="doctorspecialization_id" class="form-select form-select-sm"
                                        id="doctorspecializationid">
                                        <option value>Select Specialization</option>
                                        @foreach ($doctorspecialization_data as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-1">
                        <button wire:click="export" class="btn btn-sm btn-success fw-bold"> Excel
                            <i class="bi bi-arrow-down"></i></button>
                        <button wire:click="pdf" class="btn btn-sm btn-success fw-bold"> PDF
                            <i class="bi bi-arrow-down"></i></button>
                        <button wire:click="clear" class="btn btn-sm btn-secondary"> Clear</button>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-md-10 row">
                            <div class="col fw-bold fs-6">Selected Doctor: <span
                                    class="text-success">{{ $doctorname }}</span>
                            </div>
                            <div class="col fw-bold fs-6">Selected Specialization: <span
                                    class="text-success">{{ $specializationname }}</span></div>
                        </div>
                        <div class="col-auto align-self-end">
                            <select wire:click="updatepagination" wire:model.lazy="paginationlength"
                                class="form-select form-select-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="patientreport_id" class="table text-center table-hover m-0 p-0">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            <th>S.NO</th>
                            <th>DATE</th>
                            <th>UHID</th>
                            <th>PATIENT NAME</th>
                            <th>PATIENT PHONE</th>
                            <th>SPECIALITY</th>
                            <th>REF BY</th>
                            <th>DOCTOR NAME</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patientvisit as $key => $item)
                            <tr>
                                <td>{{ $patientvisit->firstItem() + $key }}</td>
                                <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                                <td>{{ $item->patient?->uhid }}</td>
                                <td>{{ $item->patient?->name }}</td>
                                <td>{{ $item->patient?->phone }}</td>
                                <td>{{ $item->doctorspecialization->name }}</td>
                                <td>{{ $item->reference->name ?? '-' }}</td>
                                <td>{{ $item->doctor->name ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $patientvisit->links() !!}
            </div>
        </div>
    </div>
</div>
