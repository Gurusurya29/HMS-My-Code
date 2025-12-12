<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            REFERENCE MASTER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-referance')
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
            @can('View-referance')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-referance')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($reference as $index => $eachreference)
                <tr>
                    <td>{{ $reference->firstItem() + $index }}</td>
                    <td>{{ $eachreference->uniqid }}</td>
                    <td class="text-center">{{ $eachreference->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachreference->active,
                        ])
                    </td>
                    @can('View-referance')
                        <td>
                            <button wire:click="show({{ $eachreference->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>

                        </td>
                    @endcan
                    @can('Edit-referance')
                        <td>
                            <button wire:click="edit({{ $eachreference->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $reference->firstItem() }} to {{ $reference->lastItem() }} out of
            {{ $reference->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $reference->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.patientregisterationsetting.referencemaster.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.patientregisterationsetting.referencemaster.show')

</div>
