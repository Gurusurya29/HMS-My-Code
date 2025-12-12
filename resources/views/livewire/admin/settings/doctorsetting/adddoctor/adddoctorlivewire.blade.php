<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            ADD DOCTOR
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-newdoctor')
                <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                    data-bs-toggle="modal" data-bs-target="#createoreditModal">
                    Add Doctor
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
            @foreach ($adddoctor as $index => $eachadddoctor)
                <tr>
                    <td>{{ $adddoctor->firstItem() + $index }}</td>
                    <td>{{ $eachadddoctor->uniqid }}</td>
                    <td class="text-center">{{ $eachadddoctor->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachadddoctor->active,
                        ])
                    </td>
                    @can('View-doctor')
                        <td>
                            <button wire:click="show({{ $eachadddoctor->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-doctor')
                        <td>
                            <button wire:click="edit({{ $eachadddoctor->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $adddoctor->firstItem() }} to {{ $adddoctor->lastItem() }} out of
            {{ $adddoctor->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $adddoctor->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.doctorsetting.adddoctor.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.doctorsetting.adddoctor.show')

</div>
