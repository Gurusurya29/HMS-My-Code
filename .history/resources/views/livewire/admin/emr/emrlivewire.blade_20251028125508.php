<div class="row justify-content-center">
    <div class="my-3 col-md-8">
        <div class="dropdown">
            <label class="form-label fs-5" for="searchquery">Search Patient :</label>
            <input type="text" class="form-control shadow-sm border border-1 border-info" id="searchquery"
                placeholder="Search Patient..." wire:model="searchquery"   wire:model.live.debounce.300ms="searchquery" />

              <ul wire:loading class="dropdown-menu list-group w-100"  style="display: {{ $searchquery ? 'block' : 'none' }}">
                <li class="ist-group-item d-flex justify-content-between align-items-center">
                    Searching...</li>
            </ul>

            @if (!empty($searchquery))
                <ul class="dropdown-menu list-group w-100 p-0">
                    @if (!empty($patientlist))
                        @foreach ($patientlist as $i => $eachpatientlist)
                            <li wire:click="selectedpatient({{ $eachpatientlist['id'] }})"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                role="button">
                                <h6> {{ $eachpatientlist['name'] }} </h6>

                                <h5>
                                    <span class=" badge bg-success rounded-pill">
                                        Phone: {{ $eachpatientlist['phone'] }}</span>
                                </h5>
                                <h5>
                                    <span class=" badge bg-primary rounded-pill">
                                        {{ $eachpatientlist['uhid'] }}</span>
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
            @endif
        </div>
    </div>
    @if ($patient)
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-bordered border-secondary shadow-sm table-success text-center">
                    <thead class="fw-bold " style="font-size: 16px;">
                        <tr>
                            <th scope="col">UHID</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Aadhar</th>
                            <th scope="col">DOB</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fs-5">
                            <td>{{ $patient->uhid ?? '-' }}</td>
                            <td>{{ $patient->name ?? '-' }}</td>
                            <td>{{ $patient->phone ?? '-' }}</td>
                            <td>{{ $patient->aadharid ?? '-' }}</td>
                            <td>{{ $patient->dob ? date('d-m-Y', strtotime($patient->dob)) : '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('livewire.admin.emr.emrpatientdetails')
        </div>
        <div class="card p-0 my-4 col-md-11">
            <div class="card-header text-white theme_bg_color"> EMR LIST</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped p-0 m-0">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">DATE</th>
                                <th scope="col">ID</th>
                                <th scope="col">TYPE</th>
                                <th scope="col">DOCTOR</th>
                                <th scope="col">VIEW</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emrlist as $index => $eachemrlist)
                                <tr>
                                    <td>{{ $emrlist->firstItem() + $index }}</td>
                                    <td class="">{{ $eachemrlist->created_at->format('d-m-Y h:i A') }}</td>
                                    <td class="">{{ $eachemrlist->emrable->uniqid }}</td>
                                    <td class="">{{ $eachemrlist->type }}</td>
                                    <td class="">{{ $eachemrlist->doctor->name ?? '-' }}</td>
                                    <td class="">
                                        <button wire:click="show({{ $eachemrlist->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                                        <!-- <button type="button"
                                            wire:click="show({{ $eachemrlist->id }}, '{{ $eachemrlist->type }}')"
                                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex bd-highlight">
                        <div class="p-1 bd-highlight"> Showing {{ $emrlist->firstItem() }} to
                            {{ $emrlist->lastItem() }} out of
                            {{ $emrlist->total() }} items</div>
                        <div class="ms-auto p-1 bd-highlight"> {{ $emrlist->links() }}</div>
                    </div>

                </div>
            </div>
        </div>
        @switch ($showdatatype)
            @case ('Patient Registration')
                @include('livewire.admin.patientregistration.patientmasterlist.show')
            @break

            @case ('Patient Visit')
                @include('livewire.admin.patientregistration.patientvisithistory.show')
            @break

            @case ('Out Patient')
                @include('livewire.admin.outpatient.outpatienthistory.show')
            @break

            @case ('In Patient')
                @include('livewire.admin.inpatient.inpatienthistory.show')
            @break

            @default
            @break
        @endswitch
    @endif
</div>
