<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            DIAGNOSIS MASTER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-diagnosis')
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
            @can('View-diagnosis')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-diagnosis')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($diagnosismaster as $index => $eachdiagnosismaster)
                <tr>
                    <td>{{ $diagnosismaster->firstItem() + $index }}</td>
                    <td>{{ $eachdiagnosismaster->uniqid }}</td>
                    <td class="text-center">{{ $eachdiagnosismaster->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachdiagnosismaster->active,
                        ])
                    </td>
                    @can('View-diagnosis')
                        <td>
                            <button wire:click="show({{ $eachdiagnosismaster->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-diagnosis')
                        <td>
                            <button wire:click="edit({{ $eachdiagnosismaster->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $diagnosismaster->firstItem() }} to {{ $diagnosismaster->lastItem() }} out of
            {{ $diagnosismaster->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $diagnosismaster->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.opsetting.diagnosismaster.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.opsetting.diagnosismaster.show')

</div>
