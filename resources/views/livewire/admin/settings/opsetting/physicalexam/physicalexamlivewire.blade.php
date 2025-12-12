<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            PHYSICAL & GENERAL EXAMINATION MASTER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-physicalandgeneral')
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
            @can('View-physicalandgeneral')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-physicalandgeneral')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($physicalexam as $index => $eachphysicalexam)
                <tr>
                    <td>{{ $physicalexam->firstItem() + $index }}</td>
                    <td>{{ $eachphysicalexam->uniqid }}</td>
                    <td class="text-center">{{ $eachphysicalexam->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachphysicalexam->active,
                        ])
                    </td>
                    @can('View-physicalandgeneral')
                        <td>
                            <button wire:click="show({{ $eachphysicalexam->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-physicalandgeneral')
                        <td>
                            <button wire:click="edit({{ $eachphysicalexam->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $physicalexam->firstItem() }} to
            {{ $physicalexam->lastItem() }} out of
            {{ $physicalexam->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $physicalexam->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.opsetting.physicalexam.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.opsetting.physicalexam.show')
</div>
