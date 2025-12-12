<div class="mt-4">
    <x-laboratory.layouts.laboratoryindex>

        <x-slot name="title">
            RECEIPT HISTORY
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
                'name' => 'RECEIPT ID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UHID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PATIENT NAME',
                'type' => 'normal',
                'sortname' => '',
            ])

            @include('helper.tablehelper.tableheader', [
                'name' => 'MOBILE NUMBER',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'RECEIPT TYPE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PAID AMOUNT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PAID ON',
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
            @foreach ($receipthistory as $index => $eachreceipthistory)
                <tr>
                    <td>{{ $receipthistory->firstItem() + $index }}</td>
                    <td class="text-center">
                        {{ $eachreceipthistory->receipt_uniqid }}
                    </td>
                    <td class="text-center">{{ $eachreceipthistory->patient->uhid }}</td>
                    <td class="text-center">{{ $eachreceipthistory->patient->name }}</td>
                    <td class="text-center">{{ $eachreceipthistory->patient->phone }}</td>
                    <td class="text-center">
                        {{ $eachreceipthistory->receipt_type? collect(config('archive.receipt_type'))->where('id', $eachreceipthistory->receipt_type)->first()['subtype']: '-' }}
                    </td>
                    <td class="text-center">{{ $eachreceipthistory->received_amount }}</td>
                    <td class="text-center">{{ $eachreceipthistory->created_at }}</td>
                    <td class="text-center">
                        <button wire:click="show({{ $eachreceipthistory->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <button wire:click="printreceiptentry({{ $eachreceipthistory->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $receipthistory->firstItem() }} to {{ $receipthistory->lastItem() }} out of
            {{ $receipthistory->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $receipthistory->links() }}
        </x-slot>

    </x-laboratory.layouts.laboratoryindex>

    @include('livewire.laboratory.receipt.show')
</div>
