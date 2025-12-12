<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            INSURANCE COMPANY
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-insurancecompany')
                <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                    data-bs-toggle="modal" data-bs-target="#createoreditModal">
                    ADD
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
            @can('View-insurancecompany')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-insurancecompany')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($insurancecompany as $index => $eachinsurancecompany)
                <tr>
                    <td>{{ $insurancecompany->firstItem() + $index }}</td>
                    <td>{{ $eachinsurancecompany->uniqid }}</td>
                    <td class="text-center">{{ $eachinsurancecompany->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachinsurancecompany->active,
                        ])
                    </td>
                    @can('View-insurancecompany')
                        <td>
                            <button wire:click="show({{ $eachinsurancecompany->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-insurancecompany')
                        <td>
                            <button wire:click="edit({{ $eachinsurancecompany->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $insurancecompany->firstItem() }} to {{ $insurancecompany->lastItem() }} out of
            {{ $insurancecompany->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $insurancecompany->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.insurancesetting.insurancecompany.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.insurancesetting.insurancecompany.show')

</div>
