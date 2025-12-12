<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            ROLE
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-userrole')
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
                'name' => 'ROLE',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('Assignpermission-userrole')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'ASSIGN PERMISSION',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('View-userrole')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-userrole')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan

        </x-slot>

        <x-slot name="tablebody">
            @foreach ($role as $index => $eachrole)
                <tr>
                    <td>{{ $role->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachrole->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachrole->active,
                        ])
                    </td>
                    @can('Assignpermission-userrole')
                        <td>
                            <a href="permission/{{ $eachrole->id }}" class="btn btn-sm btn-primary"><i
                                    class="bi bi-person-check-fill"></i></a>
                        </td>
                    @endcan
                    @can('View-userrole')
                        <td>
                            <button wire:click="show({{ $eachrole->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-userrole')
                        <td>
                            <button wire:click="edit({{ $eachrole->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan


                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $role->firstItem() }} to {{ $role->lastItem() }} out of
            {{ $role->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $role->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.user.role.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.user.role.show')

</div>
