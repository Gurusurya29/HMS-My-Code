<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            WARD FLOOR / BLOCK
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-wardfloor/block')
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
                'name' => 'WARD FLOOR / BLOCK',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-wardfloor/block')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-wardfloor/block')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($wardfloor as $index => $eachwardfloor)
                <tr>
                    <td>{{ $wardfloor->firstItem() + $index }}</td>
                    <td>{{ $eachwardfloor->uniqid }}</td>
                    <td class="text-center">{{ $eachwardfloor->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachwardfloor->active,
                        ])
                    </td>
                    @can('View-wardfloor/block')
                        <td>
                            <button wire:click="show({{ $eachwardfloor->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-wardfloor/block')
                        <td>
                            <button wire:click="edit({{ $eachwardfloor->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $wardfloor->firstItem() }} to {{ $wardfloor->lastItem() }} out of
            {{ $wardfloor->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $wardfloor->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.wardsetting.wardfloor.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.wardsetting.wardfloor.show')

</div>
