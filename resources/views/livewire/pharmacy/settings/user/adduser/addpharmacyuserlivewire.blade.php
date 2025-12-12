<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            ADD USER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacysettings') }}"
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
                'name' =>
                    auth()->guard('pharmacy')->user()->role == 'superadmin'
                        ? 'VIEW/EDIT'
                        : 'VIEW',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($pharmacy as $index => $eachpharmacy)
                <tr>
                    <td>{{ $pharmacy->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachpharmacy->uniqid }}</td>
                    <td class="text-center">{{ $eachpharmacy->name }}</td>
                    <td class="text-center">{{ $eachpharmacy->phone }}</td>
                    <td class="text-center">{{ $eachpharmacy->email }}</td>
                    <td>{{ $eachpharmacy->is_accountactive ? 'Active' : 'InActive' }}</td>
                    <td>{{ $eachpharmacy->created_at->format('d-m-Y h:i A') }}</td>
                    <td>
                        <button wire:click="show({{ $eachpharmacy->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        @if (auth()->guard('pharmacy')->user()->role == 'superadmin')
                            <button wire:click="edit({{ $eachpharmacy->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmacy->firstItem() }} to {{ $pharmacy->lastItem() }} out of {{ $pharmacy->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmacy->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    <!-- Create or Edit Modal -->
    @include('livewire.pharmacy.settings.user.adduser.createoredit')

    <!-- Show Modal -->
    @include('livewire.pharmacy.settings.user.adduser.show')

</div>
