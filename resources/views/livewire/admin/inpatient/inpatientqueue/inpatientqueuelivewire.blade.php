<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            IN PATIENT QUEUE
        </x-slot>

        <x-slot name="action">

        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UHID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PATIENT NAME',
                'type' => 'normal',
                'sortname' => '',
            ])

            @include('helper.tablehelper.tableheader', [
                'name' => 'MOBILE NUMBER',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DOCTOR',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SPECIALITY',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'WARD-ROOM',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('Inpatient-admission')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'ADMISSION',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Inpatient-nursingstation')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'NURSING STATION',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @include('helper.tablehelper.tableheader', [
                'name' => 'OT STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('Inpatient-discharge')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'INITIATE DISCHARGE',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($inpatient as $index => $eachpatient)
                <tr>
                    <td>{{ $inpatient->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachpatient->patient->uhid }}</td>
                    <td class="text-center">{{ $eachpatient->patient->name }}</td>
                    <td class="text-center">{{ $eachpatient->patient->phone }}</td>
                    <td class="text-center">{{ $eachpatient->patientvisit->doctor->name }}</td>
                    <td class="text-center">
                        @if ($eachpatient->patientvisit->doctorspecialization_id)
                            <h4 class="badge rounded-pill bg-secondary fs-6">
                                {{ $eachpatient->patientvisit->doctorspecialization->name }}
                            </h4>
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        @if ($eachpatient->ipadmission)
                            {{ $eachpatient->ipadmission->wardtype->name }} -
                            {{ $eachpatient->ipadmission->bedorroomnumber->name }}
                        @else
                            Not Assigned
                        @endif
                    </td>
                    @can('Inpatient-admission')
                        <td>
                            <a href="{{ route('inpatientadmission', ['uuid' => $eachpatient->uuid]) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-person-fill"></i></a>
                        </td>
                    @endcan
                    @can('Inpatient-nursingstation')
                        <td>
                            @if ($eachpatient->ipadmission)
                                <a href="{{ route('ipnursingstationservice', ['uuid' => $eachpatient->uuid]) }}"
                                    class="btn btn-sm btn-success">Nursing Station</a>
                            @else
                                Admission Not Initiated
                            @endif
                        </td>
                    @endcan
                    <td>
                        @if ($eachpatient->is_movedto_ot)
                            {{-- <div class="badge rounded-pill bg-success p-2 align-middle"> </div> --}}
                            <span class="text-dark fw-bold">Moved to OT</span>
                        @else
                            -
                        @endif
                    </td>

                    @can('Inpatient-discharge')
                        <td>
                            @if ($eachpatient->ipadmission)
                                <a href="{{ route('inpatientdischarge', $eachpatient->uuid) }}"
                                    class="btn btn-sm btn-warning">Discharge</a>
                            @else
                                Admission Not Initiated
                            @endif
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $inpatient->firstItem() }} to {{ $inpatient->lastItem() }} out of
            {{ $inpatient->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $inpatient->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

</div>
