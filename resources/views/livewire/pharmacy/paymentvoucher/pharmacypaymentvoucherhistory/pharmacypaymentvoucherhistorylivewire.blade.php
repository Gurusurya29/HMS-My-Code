<div class="mt-4">
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PAYMENT VOUCHER HISTORY
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
                'name' => 'PAYMENT ID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'NAME ( ID )',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PHONE',
                'type' => 'normal',
                'sortname' => '',
            ])

            @include('helper.tablehelper.tableheader', [
                'name' => 'PAID AMOUNT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PAYMENT MODE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PAID ON',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'RECEIPT BY',
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
            @foreach ($paymentvoucherhistory as $index => $eachpaymentvoucherhistory)
                <tr>
                    <td>{{ $paymentvoucherhistory->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachpaymentvoucherhistory->paymentvoucher_uniqid }}</td>
                    <td class="text-center">
                        {{ $eachpaymentvoucherhistory->paymentvoucher_user }}
                    </td>
                    <td class="text-center">
                        {{ $eachpaymentvoucherhistory->paymentvoucher_phone }}
                    </td>
                    <td class="text-center">{{ $eachpaymentvoucherhistory->paid_amount }}</td>
                    <td class="text-center">
                        {{ config('archive.modeofpayment')[$eachpaymentvoucherhistory->modeofpayment] }}
                    </td>
                    <td class="text-center">{{ $eachpaymentvoucherhistory->created_at }}</td>
                    <td class="text-center">{{ $eachpaymentvoucherhistory->creatable->name }}</td>
                    <td class="text-center">
                        <button wire:click="show({{ $eachpaymentvoucherhistory->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                        <button wire:click="printpaymentvoucherentry({{ $eachpaymentvoucherhistory->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $paymentvoucherhistory->firstItem() }} to {{ $paymentvoucherhistory->lastItem() }} out of
            {{ $paymentvoucherhistory->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $paymentvoucherhistory->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    @include('livewire.pharmacy.paymentvoucher.pharmacypaymentvoucherhistory.show')
</div>
