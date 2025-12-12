<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PURCHASE ORDER
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
                'name' => 'Supplier Company Name',
                'type' => 'sortby',
                'sortname' => 'supplier_companyname',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'MOBILE NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CONTACT NAME',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DATE',
                'type' => 'sortby',
                'sortname' => 'planning_date',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'TAXABLE AMT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'TAX AMT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'TOTAL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/PRINT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PO STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="nostrip">
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($pharmorder as $index => $eachpharmorder)
                <tr class="{{ $eachpharmorder->po_status ? 'text-success' : 'text-danger' }}">
                    <td>{{ $pharmorder->firstItem() + $index }}</td>
                    <td>{{ $eachpharmorder->uniqid }}</td>
                    <td>
                        {{ $eachpharmorder->supplier_companyname }}
                    </td>
                    <td>{{ $eachpharmorder->supplier_mobile_no }}</td>
                    <td>{{ $eachpharmorder->supplier_contact_name }}</td>
                    <td>{{ Carbon\Carbon::parse($eachpharmorder->planning_date)->format('d-m-Y') }}</td>
                    <td>{{ $eachpharmorder->taxableamt }}</td>
                    <td>{{ $eachpharmorder->taxamt }}</td>
                    <td>{{ $eachpharmorder->grand_total }}</td>
                    <td>
                        <button wire:click="show({{ $eachpharmorder->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <button wire:click="printpurchaseorder({{ $eachpharmorder->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
                    </td>
                    <td>
                        <livewire:pharmacy.purchase.purchaseorder.purchaseorderpostatuslivewire :po_id="$eachpharmorder->id"
                            :wire:key="$eachpharmorder->id">
                    </td>

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmorder->firstItem() }} to {{ $pharmorder->lastItem() }} out of
            {{ $pharmorder->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmorder->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    @include('livewire.pharmacy.purchase.purchaseorder.show')
</div>
