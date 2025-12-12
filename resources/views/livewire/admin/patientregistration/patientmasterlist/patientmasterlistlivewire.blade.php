<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            PATIENT LIST
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
                'type' => 'sortby',
                'sortname' => 'uniqid',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UHID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PATIENT NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])

            @include('helper.tablehelper.tableheader', [
                'name' => 'MOBILE NUMBER',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('Patientmasterlist-view')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Patientmasterlist-edit')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @include('helper.tablehelper.tableheader', [
                'name' => 'PRINT LABEL',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($patientlist as $index => $eachpatient)
                <tr>
                    <td>{{ $patientlist->firstItem() + $index }}</td>
                    <td>{{ $eachpatient->uniqid }}</td>
                    <td class="text-center">{{ $eachpatient->uhid }}</td>
                    <td class="text-center">{{ $eachpatient->name }}</td>
                    <td class="text-center">{{ $eachpatient->phone }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachpatient->active,
                        ])
                    </td>
                    @can('Patientmasterlist-view')
                        <td>
                            <button wire:click="show({{ $eachpatient->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Patientmasterlist-edit')
                        <td>
                            <button wire:click="edit({{ $eachpatient->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan
                    <td>
                        <button wire:click="printlabel({{ $eachpatient->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $patientlist->firstItem() }} to {{ $patientlist->lastItem() }} out of
            {{ $patientlist->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $patientlist->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Edit Modal -->
    @include('livewire.admin.patientregistration.patientregistration.patientregistrationlivewire')


    <!-- Show Modal -->
    @include('livewire.admin.patientregistration.patientmasterlist.show')

</div>
