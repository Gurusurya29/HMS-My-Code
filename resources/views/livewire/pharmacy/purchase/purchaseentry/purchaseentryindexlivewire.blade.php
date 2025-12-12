<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PURCHASE ENTIRES
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacysettings') }}"
                role="button">Back</a>
            <a style="width:100px;" class="btn btn-sm btn-primary shadow float-end mx-1"
                href="{{ route('pharmacy.pruchasecreate') }}" role="button">Add</a>
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
                'name' => 'PURCHASE ORDER ID',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SUPPLIER',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PURCHASE DATE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CGST',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SGST',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'TAX AMT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'TAXABLE AMT',
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
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($pharmacypurchaseentry as $index => $eachpharmacypurchaseentry)
                <tr>
                    <td>{{ $pharmacypurchaseentry->firstItem() + $index }}</td>
                    <td>{{ $eachpharmacypurchaseentry->uniqid }}</td>
                    <td>{{ $eachpharmacypurchaseentry->purchaseorder_uniqid }}</td>
                    <td>{{ $eachpharmacypurchaseentry->pharmpurchaseorder->supplier->company_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($eachpharmacypurchaseentry->purchase_date)->format('d-m-Y h:i:s') }}
                    </td>
                    <td>{{ $eachpharmacypurchaseentry->cgst }}</td>
                    <td>{{ $eachpharmacypurchaseentry->sgst }}</td>
                    <td>{{ $eachpharmacypurchaseentry->taxamt }}</td>
                    <td>{{ $eachpharmacypurchaseentry->taxableamt }}</td>
                    <td>{{ $eachpharmacypurchaseentry->grand_total }}</td>
                    <td>
                        <button wire:click="show({{ $eachpharmacypurchaseentry->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                        <button wire:click="printpurchaseentry({{ $eachpharmacypurchaseentry->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmacypurchaseentry->firstItem() }} to {{ $pharmacypurchaseentry->lastItem() }} out of
            {{ $pharmacypurchaseentry->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmacypurchaseentry->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    <!-- Show Modal -->
    @include('livewire.pharmacy.purchase.purchaseentry.show')
</div>
