<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            CURRENT COMPLAINTS MASTER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-currentcomplaints')
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
            @can('View-currentcomplaints')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-currentcomplaints')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($currentcomplaint as $index => $eachcurrentcomplaint)
                <tr>
                    <td>{{ $currentcomplaint->firstItem() + $index }}</td>
                    <td>{{ $eachcurrentcomplaint->uniqid }}</td>
                    <td class="text-center">{{ $eachcurrentcomplaint->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachcurrentcomplaint->active,
                        ])
                    </td>
                    @can('View-currentcomplaints')
                        <td>
                            <button wire:click="show({{ $eachcurrentcomplaint->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-currentcomplaints')
                        <td>
                            <button wire:click="edit({{ $eachcurrentcomplaint->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $currentcomplaint->firstItem() }} to {{ $currentcomplaint->lastItem() }} out of
            {{ $currentcomplaint->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $currentcomplaint->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.patientvisitsetting.currentcomplaints.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.patientvisitsetting.currentcomplaints.show')

</div>
