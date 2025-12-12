<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            WARD TYPE
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-wardtype')
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
                'name' => 'WARD TYPE',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'WARD CATEGORY',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-doctor')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-doctor')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($wardtypelist as $index => $eachwardtype)
                <tr>
                    <td>{{ $wardtypelist->firstItem() + $index }}</td>
                    <td>{{ $eachwardtype->uniqid }}</td>
                    <td class="text-center">{{ $eachwardtype->name }}</td>
                    <td class="text-center">{{ config('archive.ward_category')[$eachwardtype->ward_category] }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachwardtype->active,
                        ])
                    </td>
                    @can('View-wardtype')
                        <td>
                            <button wire:click="show({{ $eachwardtype->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-wardtype')
                        <td>
                            <button wire:click="edit({{ $eachwardtype->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $wardtypelist->firstItem() }} to {{ $wardtypelist->lastItem() }} out of
            {{ $wardtypelist->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $wardtypelist->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.wardsetting.wardtype.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.wardsetting.wardtype.show')

</div>
