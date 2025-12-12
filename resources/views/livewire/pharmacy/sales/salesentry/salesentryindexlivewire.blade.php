<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            SALE ENTRY
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-primary shadow float-end mx-1" href="{{ route('pharmacy.salesentrycreate') }}"
                role="button">Add New Sales Entry</a>
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
            'name' => 'S.NO',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'BILL NO.',
            'type' => 'sortby',
            'sortname' => 'uniqid',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'MAIN TYPE',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'SUB TYPE',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'PATIENT NAME',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'PATIENT PHONE NO.',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'DOCTOR NAME',
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
            'name' => 'GRAND TOTAL',
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
            @foreach ($salesentry as $index => $eachsalesentry)
            <tr>
                <td>{{ $salesentry->firstItem() + $index }}</td>
                <td>{{ $eachsalesentry->uniqid }}</td>
                <td>{{ $eachsalesentry->maintype }}</td>
                <td>{{ $eachsalesentry->subtype }}</td>
                <td>{{ $eachsalesentry->patient->name }}</td>
                <td>{{ $eachsalesentry->patient->phone }}</td>
                <td>{{ $eachsalesentry->doctor->name }}</td>
                <td>{{ $eachsalesentry->taxamt }}</td>
                <td>{{ $eachsalesentry->taxableamt }}</td>
                <td>{{ $eachsalesentry->grand_total }}</td>
                <td>
                    <button wire:click="show({{ $eachsalesentry->id }})" class="btn btn-sm btn-success"><i
                            class="bi bi-eye-fill"></i></button>
                    <button wire:click="printsalesentry({{ $eachsalesentry->id }})" class="btn btn-sm btn-success"><i
                            class="bi bi-printer"></i></button>
                </td>
            </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $salesentry->firstItem() }} to {{ $salesentry->lastItem() }} out of
            {{ $salesentry->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $salesentry->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    {{-- show --}}
    @include('livewire.pharmacy.sales.salesentry.show')
</div>