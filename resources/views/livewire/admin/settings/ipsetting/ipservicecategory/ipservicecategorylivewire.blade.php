<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            IP SERVICE CATEGORY
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-ipservicecategory')
                <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                    data-bs-toggle="modal" data-bs-target="#createoreditModal">
                    Create
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
                'name' => 'NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-ipservicecategory')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-ipservicecategory')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($ipservicecategory as $index => $eachipservicecategory)
                <tr>
                    <td>{{ $ipservicecategory->firstItem() + $index }}</td>
                    <td>{{ $eachipservicecategory->uniqid }}</td>
                    <td class="text-center">{{ $eachipservicecategory->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachipservicecategory->active,
                        ])
                    </td>
                    @can('View-ipservicecategory')
                        <td>
                            <button wire:click="show({{ $eachipservicecategory->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-ipservicecategory')
                        <td>
                            <button wire:click="edit({{ $eachipservicecategory->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $ipservicecategory->firstItem() }} to {{ $ipservicecategory->lastItem() }} out of
            {{ $ipservicecategory->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $ipservicecategory->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.ipsetting.ipservicecategory.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.ipsetting.ipservicecategory.show')

</div>
