<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PURCHASE RETURN
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacysettings') }}"
                role="button">Back</a>
            <a class="btn btn-sm btn-primary shadow float-end mx-1" href="{{ route('pharmacy.purchasereturncreate') }}"
                style="width:100px;" role="button">Add</a>
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
                'name' => 'SUPPLIER ID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SUPPLIER NAME',
                'type' => 'sortby',
                'sortname' => 'suppliercmpy_name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'ISSUE NOTE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/PRINT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($purchasereturn as $index => $eachpurchasereturn)
                <tr>
                    <td>{{ $purchasereturn->firstItem() + $index }}</td>
                    <td>{{ $eachpurchasereturn->uniqid }}</td>
                    <td>{{ $eachpurchasereturn->supplier->uniqid }}</td>
                    <td>{{ $eachpurchasereturn->suppliercmpy_name }}</td>
                    <td>{{ $eachpurchasereturn->issue_note }}</td>
                    <td>
                        <button wire:click="show({{ $eachpurchasereturn->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <button wire:click="printpurchasereturn({{ $eachpurchasereturn->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $purchasereturn->firstItem() }} to {{ $purchasereturn->lastItem() }} out of
            {{ $purchasereturn->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $purchasereturn->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    {{-- show --}}
    @include('livewire.pharmacy.purchase.purchasereturn.show')
</div>
