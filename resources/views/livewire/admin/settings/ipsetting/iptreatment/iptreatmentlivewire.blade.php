<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            IP TREATMENT
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-iptreatment')
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
                'name' => 'NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-iptreatment')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-iptreatment')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($iptreatment as $index => $eachiptreatment)
                <tr>
                    <td>{{ $iptreatment->firstItem() + $index }}</td>
                    <td>{{ $eachiptreatment->uniqid }}</td>
                    <td class="text-center">{{ $eachiptreatment->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachiptreatment->active,
                        ])
                    </td>
                    @can('View-iptreatment')
                        <td>
                            <button wire:click="show({{ $eachiptreatment->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-iptreatment')
                        <td>
                            <button wire:click="edit({{ $eachiptreatment->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $iptreatment->firstItem() }} to {{ $iptreatment->lastItem() }} out of
            {{ $iptreatment->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $iptreatment->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.ipsetting.iptreatment.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.ipsetting.iptreatment.show')

</div>
