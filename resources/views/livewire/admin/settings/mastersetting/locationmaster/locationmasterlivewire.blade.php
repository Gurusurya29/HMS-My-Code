<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            LOCATION MASTER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                data-bs-toggle="modal" data-bs-target="#createoreditModal">
                Add
            </button>
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
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/EDIT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($locationmaster as $index => $eachlocationmaster)
                <tr>
                    <td>{{ $locationmaster->firstItem() + $index }}</td>
                    <td>{{ $eachlocationmaster->uniqid }}</td>
                    <td class="text-center">{{ $eachlocationmaster->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachlocationmaster->active,
                        ])
                    </td>
                    <td>
                        <button wire:click="show({{ $eachlocationmaster->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <button wire:click="edit({{ $eachlocationmaster->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-pencil-fill"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $locationmaster->firstItem() }} to
            {{ $locationmaster->lastItem() }} out of
            {{ $locationmaster->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $locationmaster->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.mastersetting.locationmaster.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.mastersetting.locationmaster.show')

</div>
