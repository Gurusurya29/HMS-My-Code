<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            ADD USER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-newuser')
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
                'name' => 'UNIQID',
                'type' => 'sortby',
                'sortname' => 'uniqid',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'USER',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PHONE',
                'type' => 'sortby',
                'sortname' => 'phone',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'EMAIL',
                'type' => 'sortby',
                'sortname' => 'email',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'sortby',
                'sortname' => 'is_accountactive',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CREATED BY',
                'type' => 'sortby',
                'sortname' => 'user_id',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CREATED AT ',
                'type' => 'sortby',
                'sortname' => 'created_at',
            ])
            @can('View-user')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-user')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($user as $index => $eachuser)
                <tr>
                    <td>{{ $user->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachuser->uniqid }}</td>
                    <td class="text-center">{{ $eachuser->name }}</td>
                    <td class="text-center">{{ $eachuser->phone }}</td>
                    <td class="text-center">{{ $eachuser->email }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachuser->is_accountactive,
                        ])
                    </td>
                    <td class="text-center">{{ $eachuser->createdby?->name }}</td>
                    <td>{{ $eachuser->created_at->format('d-m-Y h:i A') }}</td>
                    @can('View-user')
                        <td>
                            <button wire:click="show({{ $eachuser->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-user')
                        <td>
                            <button wire:click="edit({{ $eachuser->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $user->firstItem() }} to {{ $user->lastItem() }} out of {{ $user->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $user->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.user.user.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.user.user.show')

</div>
