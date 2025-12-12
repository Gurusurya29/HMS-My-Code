<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            ALLERGY MASTER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-allergy')
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
            @can('View-allergy')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-allergy')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($allergymaster as $index => $eachallergymaster)
                <tr>
                    <td>{{ $allergymaster->firstItem() + $index }}</td>
                    <td>{{ $eachallergymaster->uniqid }}</td>
                    <td class="text-center">{{ $eachallergymaster->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachallergymaster->active,
                        ])
                    </td>
                    @can('View-allergy')
                        <td>
                            <button wire:click="show({{ $eachallergymaster->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-allergy')
                        <td>
                            <button wire:click="edit({{ $eachallergymaster->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $allergymaster->firstItem() }} to {{ $allergymaster->lastItem() }} out of
            {{ $allergymaster->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $allergymaster->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.patientvisitsetting.allergymaster.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.patientvisitsetting.allergymaster.show')

</div>
