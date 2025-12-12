<div>
    @livewire('admin.patientregistration.patientregistration.patientregistrationlivewire')
    <form wire:submit.prevent="store()" autocomplete="off">
        <div class="row g-2 mt-1 col-md-10 mx-auto">
            <div class="col-md-8">
                <input wire:model.debounce.150ms="patient_selected" wire:focus="searchpatientfoucs"
                    wire:change="searchpatient" wire:keyup="searchpatient" type="text"
                    class="form-control form-control-md bg-white shadow-sm" autofocus
                    placeholder="Search Patient Name / Phone / UHID / Patient ID / Aadhar">
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary shadow-sm mx-1" data-bs-toggle="modal"
                    data-bs-target="#createoreditModal">
                    Add New Patient
                </button>
                @if ($patient_uhid)
                    <button wire:click="formreset" type="submit" class="btn btn-secondary shadow-sm">Clear</button>
                @endif
            </div>
        </div>
        @if (!empty($patient_selected))
            <div class="col-md-10 mx-auto bg-light">
                <ul class="dropdown-menu list-group w-75 text-center border-0 py-0">
                    @if (!empty($searchpatientlist))
                        @foreach ($searchpatientlist as $i => $eachsearchpatientlist)
                            <li wire:click="selectpatient('{{ $eachsearchpatientlist->id }}')"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center shadow-sm bg-light fw-bold"
                                role="button">
                                <h5>
                                    <span class="text-danger">{{ $eachsearchpatientlist->uhid }}</span> /
                                    <span class="text-dark"> Name : {{ $eachsearchpatientlist->name }} </span>
                                </h5>

                                <h5>
                                    <span class=" badge bg-primary rounded-pill">Ph:
                                        {{ $eachsearchpatientlist->phone }}</span>

                                    @if ($eachsearchpatientlist->aadharid)
                                        <span class="badge bg-success rounded-pill">Aadhar:
                                            {{ $eachsearchpatientlist->aadharid }}</span>
                                    @elseif($eachsearchpatientlist->dob)
                                        <span class="badge bg-success rounded-pill">DOB:
                                            {{ \Carbon\Carbon::parse($eachsearchpatientlist->dob)->format('d-m-Y') }}</span>
                                    @elseif($eachsearchpatientlist->email)
                                        <span class="badge bg-success rounded-pill">Email:
                                            {{ $eachsearchpatientlist->email }}</span>
                                    @endif
                                </h5>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            No results!
                            <span class="badge bg-primary rounded-pill">0</span>
                        </li>
                    @endif
                </ul>
            </div>
        @endif

        @if ($patient_uhid)

            <div class="card mt-3 shadow-sm border-0">
                <div class="table-responsive shadow-sm">
                    <table class="table table-bordered table-success p-0 m-0 text-center">
                        <thead class="georgiafont">
                            <tr>
                                <th>UHID</th>
                                <th>NAME</th>
                                <th>PHONE</th>
                                <th>DOB</th>
                                <th>EMAIL</th>
                                <th>AADHAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ $patient_uhid }}</th>
                                <td>{{ $name }}</td>
                                <td>{{ $phone }}</td>
                                <td>{{ $dob }}</td>
                                <td>{{ $email }}</td>
                                <td>{{ $aadharid }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row g-2 m-1">
                <div class="col-md-6">
                    <div class="row mt-2 position-relative mb-3">
                        <div class="col-md-7">
                            <label for="doctor_nameid" class="form-label fw-bold">DOCTOR</label>
                            <span class="text-danger fw-bold">*</span>
                            <input wire:model.debounce.150ms="doctor_name" wire:keyup="searchdoctor"
                                wire:focus="searchdoctorfoucs" id="doctor_name" class="form-control" autocomplete="off"
                                type="text" placeholder="Search or Enter Doctor" id="doctor_nameid">
                            @error('doctor_name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                            @if (!empty($doctor_name))
                                <ul class="list-group position-absolute" style="z-index: 50;width:55%;">
                                    @if ($searchdoctorlist)
                                        @foreach ($searchdoctorlist as $i => $eachsearchdoctorlist)
                                            <li wire:click="selectdoctor('{{ $eachsearchdoctorlist->id }}')"
                                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <span class=" badge bg-primary rounded-pill">ID :
                                                    {{ $eachsearchdoctorlist->uniqid }}</span>
                                                <span>{{ $eachsearchdoctorlist->name }} </span>

                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="card border-0 bg-light">
                        <div class="card-body p-0">
                            <div class="mx-auto">
                                <div class="dropdown">
                                    <label for="searchqueryid" class="col-form-label fw-bold">SEARCH
                                        INVESTIGATION</label>
                                    <input type="text" class="form-control shadow-sm bg-white"
                                        placeholder="Search Investigation..." wire:model="searchquery"   wire:model.live.debounce.300ms="searchquery" />

                                    {{--   <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                                    <li class="ist-group-item d-flex justify-content-between align-items-center">
                                        Searching...</li>
                                </ul> --}}

                                    @if (!empty($searchquery))
                                        <ul class="dropdown-menu list-group w-100 border-0 m-0 p-0">
                                            @if (!empty($xrayinvestigation))
                                                @foreach ($xrayinvestigation as $i => $eachxrayinvestigation)
                                                    <li wire:click="additem({{ $eachxrayinvestigation['id'] }})"
                                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                                        role="button">
                                                        <h6> {{ $eachxrayinvestigation['name'] }} </h6>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    No results!
                                                    <span class="badge bg-primary rounded-pill">0</span>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($selectedxrayinvestigation)
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-header text-white theme_bg_color fs-5 d-flex justify-content-between">
                                <div>
                                    Investigation List
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped p-0 m-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Investigation Name</th>
                                                <th scope="col">Amount</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($selectedxrayinvestigation)
                                                @foreach ($selectedxrayinvestigation as $key => $eachxrayinvestigation)
                                                    <tr>
                                                        <td>
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td>
                                                            {{ $eachxrayinvestigation['labinvestigation_name'] }}
                                                        </td>
                                                        <td>
                                                            {{ $eachxrayinvestigation['selffee'] }}
                                                        </td>
                                                        <td class="text-center">
                                                            <button
                                                                wire:click.prevent="removeitem({{ $key }})"
                                                                class="btn btn-danger btn-sm"><i
                                                                    class="bi bi-trash-fill"></i> </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-muted">No record found
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                @if (!empty($selectedxrayinvestigation))
                                    <div class="mt-2 row align-items-center justify-content-end">

                                        <div class="col-md-5">
                                            <table class="table table-borderless">
                                                <tbody class="fs-5">
                                                    <tr>
                                                        <th class="text-end">Total:</th>
                                                        <td>Rs.{{ $totalxraycost }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if ($selectedxrayinvestigation)
                                <div class="card-footer text-center bg-light px-2 py-1">
                                    <a href="" class="btn btn-secondary">Cancel</a>
                                    <div wire:loading wire:target="store">
                                        <button class="btn btn-primary" type="button" disabled>
                                            <span class="spinner-border spinner-grow-sm" role="status"
                                                aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </div>
                                    <button wire:loading.remove type="submit" wire:target="store"
                                        class="btn btn-primary">Save</button>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif
            </div>
        @endif
    </form>

</div>
