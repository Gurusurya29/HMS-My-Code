<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            State
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-state')
                <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                    data-bs-toggle="modal" data-bs-target="#createoreditModal">
                    Add
                </button>
            @endcan
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATE CODE',
                'type' => 'sortby',
                'sortname' => 'code',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATE NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'COUNTRY NAME',
                'type' => 'sortby',
                'sortname' => 'country_id',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-state')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-state')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($state as $index => $eachstate)
                <tr>
                    <td>{{ $state->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachstate?->code }}</td>
                    <td class="text-center">{{ $eachstate->name }}</td>
                    <td class="text-center">{{ $eachstate->country->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachstate->active,
                        ])
                    </td>
                    @can('View-state')
                        <td>
                            <button wire:click="show({{ $eachstate->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-state')
                        <td>
                            <button wire:click="edit({{ $eachstate->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $state->firstItem() }} to {{ $state->lastItem() }} out of
            {{ $state->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $state->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.patientregisterationsetting.states.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.patientregisterationsetting.states.show')

</div>
