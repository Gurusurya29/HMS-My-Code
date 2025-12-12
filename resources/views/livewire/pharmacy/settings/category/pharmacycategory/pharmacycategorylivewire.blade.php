<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PRODUCT CATEGORY
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1"
                href="{{ $this->currentuser()->usertype == 'ADMIN' ? route('adminpharmacysettings') : route('pharmacysettings') }}"
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
            @if ($this->currentuser()->usertype == 'ADMIN')
                @include('helper.tablehelper.tableheader', [
                    'name' => $this->currentuser()->role_id == 1 ? 'VIEW/EDIT' : 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @else
                @include('helper.tablehelper.tableheader', [
                    'name' => $this->currentuser()->isAdmin() ? 'VIEW/EDIT' : 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endif
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($pharmacycategory as $index => $eachpharmacycategory)
                <tr>
                    <td>{{ $pharmacycategory->firstItem() + $index }}</td>
                    <td>{{ $eachpharmacycategory->uniqid }}</td>
                    <td class="text-center">
                        {{ $eachpharmacycategory->name }}</td>
                    <td>
                        @include('pharmacy.common.datatable.activestatus', [
                            'status' => $eachpharmacycategory->active,
                        ])
                    </td>
                    <td>
                        <button wire:click="show({{ $eachpharmacycategory->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        @if ($this->currentuser()->usertype == 'ADMIN')
                            @if ($this->currentuser()->role_id == 1)
                                <button wire:click="edit({{ $eachpharmacycategory->id }})"
                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button>
                            @endif
                        @else
                            @if (auth()->guard('pharmacy')->user()->isAdmin())
                                <button wire:click="edit({{ $eachpharmacycategory->id }})"
                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmacycategory->firstItem() }} to {{ $pharmacycategory->lastItem() }} out of
            {{ $pharmacycategory->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmacycategory->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    <!-- Create or Edit Modal -->
    @include('livewire.pharmacy.settings.category.pharmacycategory.createoredit')

    <!-- Show Modal -->
    @include('livewire.pharmacy.settings.category.pharmacycategory.show')

</div>
