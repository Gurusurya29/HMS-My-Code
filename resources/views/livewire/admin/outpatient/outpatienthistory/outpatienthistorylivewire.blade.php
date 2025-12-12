<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            OUT PATIENT HISTORY
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
            @can('Outpatienthistory-assesment')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'UPDATE ASSESMENT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Outpatienthistory-view')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Outpatienthistory-print')
                @include('helper.tablehelper.tableheader', [
                    'name' => ' PRINT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($outpatient as $index => $eachpatient)
                <tr>
                    <td>{{ $outpatient->firstItem() + $index }}</td>
                    <td>{{ $eachpatient->uniqid }}</td>
                    <td class="text-center">{{ $eachpatient->patient->uhid }}</td>
                    <td class="text-center">{{ $eachpatient->patientvisit->uniqid }}</td>
                    <td class="text-center">{{ $eachpatient->patient->name }}</td>
                    <td class="text-center">{{ $eachpatient->patient->phone }}</td>
                    <td>{{ $eachpatient->doctor->name }}</td>
                    <td class="text-center">
                        @if ($eachpatient->doctorspecialization_id)
                            <h4 class="badge rounded-pill bg-secondary fs-6">
                                {{ $eachpatient->doctorspecialization->name }}
                            </h4>
                        @else
                            -
                        @endif

                    </td>
                    @can('Outpatienthistory-assesment')
                        <td>
                            @if (\Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($eachpatient->specialable->created_at)->addHours(24)))
                                <a href="{{ route('opassessment', ['uuid' => $eachpatient->uuid, 'requesttype' => 'update']) }}"
                                    class="btn btn-sm btn-primary"><i class="bi bi-person-fill"></i></a>
                            @else
                                -
                            @endif

                        </td>
                    @endcan
                    @can('Outpatienthistory-view')
                        <td>
                            <button wire:click="show({{ $eachpatient->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Outpatienthistory-print')
                        <td>
                            @if ($eachpatient->prescriptionable)
                                <button wire:click="printprescription({{ $eachpatient->id }})"
                                    class="btn btn-sm btn-success m-1">R<sub>x</sub></button>
                            @endif
                            <button wire:click="printassessment({{ $eachpatient->id }})"
                                class="btn btn-sm btn-success m-1"><i class="bi bi-printer"></i></button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $outpatient->firstItem() }} to {{ $outpatient->lastItem() }} out of
            {{ $outpatient->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $outpatient->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Show Modal -->
    @include('livewire.admin.outpatient.outpatienthistory.show')

</div>
