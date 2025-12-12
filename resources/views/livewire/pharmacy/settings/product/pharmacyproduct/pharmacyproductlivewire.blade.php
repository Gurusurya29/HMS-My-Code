<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PRODUCT
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
                'name' => 'SKU',
                'type' => 'sortby',
                'sortname' => 'product_sku',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'HSN',
                'type' => 'sortby',
                'sortname' => 'hsn',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CATEGORY NAME',
                'type' => 'sortby',
                'sortname' => 'pharmacycategory_id',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CURRENT STOCK',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @if ($this->currentuser()->usertype == 'ADMIN')
                @if ($this->currentuser()->role_id == 1)
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'ALTERNATIVE',
                        'type' => 'normal',
                        'sortname' => '',
                    ])
                @endif
            @else
                @if (auth()->guard('pharmacy')->user()->isAdmin())
                    @include('helper.tablehelper.tableheader', [
                        'name' => 'ALTERNATIVE',
                        'type' => 'normal',
                        'sortname' => '',
                    ])
                @endif
            @endif
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
            @foreach ($pharmacyproduct as $index => $eachpharmacyproduct)
                <tr>
                    <td>{{ $pharmacyproduct->firstItem() + $index }}</td>
                    <td>{{ $eachpharmacyproduct->uniqid }}</td>
                    <td>{{ $eachpharmacyproduct->product_sku }}</td>
                    <td>{{ $eachpharmacyproduct->hsn }}</td>
                    <td>{{ $eachpharmacyproduct->name }}</td>
                    <td>{{ $eachpharmacyproduct->pharmacycategoryname->name }}</td>
                    <td>{{ $eachpharmacyproduct->stock }}</td>
                    <td>
                        @include('pharmacy.common.datatable.activestatus', [
                            'status' => $eachpharmacyproduct->active,
                        ])
                    </td>
                    @if ($this->currentuser()->usertype == 'ADMIN')
                        @if ($this->currentuser()->role_id == 1)
                            <td>
                                <a href="{{ $this->currentuser()->usertype == 'ADMIN' ? route('adminalternativepharmacyproduct', ['productid' => $eachpharmacyproduct->id]) : route('alternativepharmacyproduct', ['productid' => $eachpharmacyproduct->id]) }}"
                                    class="btn btn-sm btn-warning"><i class="bi bi-bounding-box"></i>
                                </a>
                            </td>
                        @endif
                    @else
                        @if (auth()->guard('pharmacy')->user()->isAdmin())
                            <td>
                                <a href="{{ $this->currentuser()->usertype == 'ADMIN' ? route('adminalternativepharmacyproduct', ['productid' => $eachpharmacyproduct->id]) : route('alternativepharmacyproduct', ['productid' => $eachpharmacyproduct->id]) }}"
                                    class="btn btn-sm btn-warning"><i class="bi bi-bounding-box"></i>
                                </a>
                            </td>
                        @endif
                    @endif
                    <td>
                        <button wire:click="show({{ $eachpharmacyproduct->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        @if ($this->currentuser()->usertype == 'ADMIN')
                            @if ($this->currentuser()->role_id == 1)
                                <button wire:click="edit({{ $eachpharmacyproduct->id }})"
                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i>
                                </button>
                            @endif
                        @else
                            @if (auth()->guard('pharmacy')->user()->isAdmin())
                                <button wire:click="edit({{ $eachpharmacyproduct->id }})"
                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i>
                                </button>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmacyproduct->firstItem() }} to {{ $pharmacyproduct->lastItem() }} out of
            {{ $pharmacyproduct->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmacyproduct->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    <!-- Create or Edit Modal -->
    @include('livewire.pharmacy.settings.product.pharmacyproduct.createoredit')

    <!-- Show Modal -->
    @include('livewire.pharmacy.settings.product.pharmacyproduct.show')

</div>
