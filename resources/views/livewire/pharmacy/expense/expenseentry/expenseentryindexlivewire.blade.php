<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            EXPENSE ENTIRES
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1"
                href="{{ route('pharmacy.expenseentrycreateoredit') }}" role="button">Back</a>
            <a class="btn btn-sm btn-primary shadow float-end mx-1" href="{{ route('pharmacy.pruchasecreate') }}"
                role="button">Add</a>
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
                'name' => 'PARTY NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PAYMENT DATE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/EDIT/PRINT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($pharmacyexpenseentry as $index => $eachpharmacyexpenseentry)
                <tr>
                    <td>{{ $pharmacyexpenseentry->firstItem() + $index }}</td>
                    <td>{{ $eachpharmacyexpenseentry->uniqid }}</td>
                    <td>{{ $eachpharmacyexpenseentry->party_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($eachpharmacyexpenseentry->payment_date)->format('d-m-Y h:i:s') }}
                    </td>
                    <td>
                        <button wire:click="show({{ $eachpharmacyexpenseentry->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <a href="{{ route('pharmacy.expenseentrycreateoredit', [$eachpharmacyexpenseentry->uuid]) }}"
                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                        <button wire:click="printotreceiptlist({{ $eachpharmacyexpenseentry->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmacyexpenseentry->firstItem() }} to {{ $pharmacyexpenseentry->lastItem() }} out of
            {{ $pharmacyexpenseentry->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmacyexpenseentry->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>
    <!-- Show Modal -->

    @include('livewire.pharmacy.expense.expenseentry.show')

</div>
