<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            ADD EMPLOYEE
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('addemployee') }}"
                role="button">Back</a>
            @can('Add-newemployee')
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
                'name' => 'USER NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PHONE',
                'type' => 'sortby',
                'sortname' => 'phone',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'EMAIL',
                'type' => 'sortby',
                'sortname' => 'email',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'sortby',
                'sortname' => 'is_accountactive',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CREATED AT ',
                'type' => 'sortby',
                'sortname' => 'created_at',
            ])
            @can('View-employee')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-employee')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($employee as $index => $eachemployee)
                <tr>
                    <td>{{ $employee->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachemployee->uniqid }}</td>
                    <td class="text-center">{{ $eachemployee->name }}</td>
                    <td class="text-center">{{ $eachemployee->phone }}</td>
                    <td class="text-center">{{ $eachemployee->email }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachemployee->is_accountactive,
                        ])
                    </td>
                    <td>{{ $eachemployee->created_at->format('d-m-Y h:i A') }}</td>
                    @can('View-employee')
                        <td>
                            <button wire:click="show({{ $eachemployee->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-employee')
                        <td>
                            <button wire:click="edit({{ $eachemployee->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $employee->firstItem() }} to {{ $employee->lastItem() }} out of
            {{ $employee->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $employee->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.employee.addemployee.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.employee.addemployee.show')

</div>
