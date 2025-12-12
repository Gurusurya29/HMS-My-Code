<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            PATIENT VISIT HISTORY111
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
                'name' => 'TOKEN ID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('Patientvisithistory-view')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Patientvisithistory-edit')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @include('helper.tablehelper.tableheader', [
                'name' => 'PRINT TOKEN',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($patientvisithistory as $index => $eachpatient)
                <tr>
                    <td>{{ $patientvisithistory->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachpatient->patient->uhid }}</td>
                    <td>{{ $eachpatient->uniqid }}</td>
                    <td class="text-center">{{ $eachpatient->patient->name }}</td>
                    <td class="text-center">{{ $eachpatient->patient->phone }}</td>
                    <td class="text-center">{{ $eachpatient->token_id }}</td>
                    @can('Patientvisithistory-view')
                        <td>
                            <button wire:click="show({{ $eachpatient->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>

                        </td>
                    @endcan
                    @can('Patientvisithistory-edit')
                        <td>
                            @if ($eachpatient->visitable->specialable == false)
                                <a href="{{ route('patientvisithistoryedit', ['uuid' => $eachpatient->uuid]) }}"
                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                            @else
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                    title="Assesment Completed">
                                    <button type="button" class="btn btn-sm btn-primary" disabled><i
                                            class="bi bi-pencil-fill"></i></button>
                                </span>
                            @endif
                        </td>
                    @endcan
                    <td>
                        <button wire:click="printtoken({{ $eachpatient->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $patientvisithistory->firstItem() }} to {{ $patientvisithistory->lastItem() }} out of
            {{ $patientvisithistory->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $patientvisithistory->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Show Modal -->
    @include('livewire.admin.patientregistration.patientvisithistory.show')

    @push('scripts')
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    @endpush
</div>
