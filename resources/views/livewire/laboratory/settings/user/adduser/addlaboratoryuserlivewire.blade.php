<div>
    <x-laboratory.layouts.laboratoryindex>

        <x-slot name="title">
            ADD USER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('laboratorysettings') }}"
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
                'name' => 'USER',
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
                'name' => 'ROLE',
                'type' => 'sortby',
                'sortname' => 'role',
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
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/EDIT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($laboratory as $index => $eachlaboratory)
                <tr>
                    <td>{{ $laboratory->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachlaboratory->uniqid }}</td>
                    <td class="text-center">{{ $eachlaboratory->name }}</td>
                    <td class="text-center">{{ $eachlaboratory->phone }}</td>
                    <td class="text-center">{{ $eachlaboratory->email }}</td>
                    <td class="text-center">{{ $eachlaboratory->role }}</td>
                    <td>{{ $eachlaboratory->is_accountactive ? 'Active' : 'InActive' }}</td>
                    <td>{{ $eachlaboratory->created_at->format('d-m-Y h:i A') }}</td>
                    <td>
                        <button wire:click="show({{ $eachlaboratory->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <button wire:click="edit({{ $eachlaboratory->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-pencil-fill"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $laboratory->firstItem() }} to {{ $laboratory->lastItem() }} out of
            {{ $laboratory->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $laboratory->links() }}
        </x-slot>

    </x-laboratory.layouts.laboratoryindex>

    <!-- Create or Edit Modal -->
    @include('livewire.laboratory.settings.user.adduser.createoredit')

    <!-- Show Modal -->
    @include('livewire.laboratory.settings.user.adduser.show')

</div>
