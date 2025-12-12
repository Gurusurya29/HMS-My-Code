<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            IN PATIENT HISTORY
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
                'name' => 'UNIQID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UHID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VISIT ID',
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
            @can('Inpatienthistory-view')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Inpatienthistory-dischargeprint')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'DISCHARGE SUMMARY',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($inpatient as $index => $eachpatient)
                <tr>
                    <td>{{ $inpatient->firstItem() + $index }}</td>
                    <td>{{ $eachpatient->uniqid }}</td>
                    <td class="text-center">{{ $eachpatient->patient->uhid }}</td>
                    <td class="text-center">{{ $eachpatient->patientvisit->uniqid }}</td>
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
                    @can('Inpatienthistory-view')
                        <td>
                            <button wire:click="show({{ $eachpatient->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Inpatienthistory-dischargeprint')
                        <td>
                            <button wire:click="printdischargesummary({{ $eachpatient->id }}, 'table')"
                                class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
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
    <!-- Show Modal -->
    @include('livewire.admin.inpatient.inpatienthistory.show')
</div>
