<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="theme">
            @if ($type == 'outofstock')
                bg-danger
            @elseif($type == 'aboutto')
                customwarning
            @elseif($type == 'required')
                bg-primary
            @endif
        </x-slot>

        <x-slot name="title">
            @if ($type == 'outofstock')
                OUT OF STOCK
            @elseif($type == 'aboutto')
                ABOUT TO BE OUT OF STOCK
            @elseif($type == 'required')
                REQUIRED BY CUSTOMERS
            @endif
        </x-slot>

        <x-slot name="action">
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
            @if ($type == 'aboutto')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'STOCK',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endif
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($products as $index => $eachproducts)
                <tr>
                    <td>{{ $products->firstItem() + $index }}</td>
                    <td>{{ $eachproducts->uniqid }}</td>
                    <td>{{ $eachproducts->product_sku }}</td>
                    <td>{{ $eachproducts->hsn }}</td>
                    <td>{{ $eachproducts->name }}</td>
                    @if ($type == 'aboutto')
                        <td>{{ $eachproducts->stock }}</td>
                    @endif
                    <td>
                        @include('pharmacy.common.datatable.activestatus', [
                            'status' => $eachproducts->active,
                        ])
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} out of
            {{ $products->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $products->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>
</div>
