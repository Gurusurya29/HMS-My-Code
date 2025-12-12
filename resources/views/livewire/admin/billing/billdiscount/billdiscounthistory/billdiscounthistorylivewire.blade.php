<div class="mt-4">
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            BILL DISOCUNT/CANCEL HISTORY
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
                'name' => 'ID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PATIENT NAME',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DISCOUNT/CANCEL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'BILL TYPE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'BILL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'AMOUNT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CREATED ON',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($billdiscounthistory as $index => $eachbilldiscounthistory)
                <tr>
                    <td>{{ $billdiscounthistory->firstItem() + $index }}</td>
                    <td class="text-center">
                        {{ $eachbilldiscounthistory->uniqid }}
                    </td>
                    <td class="text-center">{{ $eachbilldiscounthistory->patient->name }}
                        ({{ $eachbilldiscounthistory->patient->uhid }})
                    </td>
                    <td class="text-center">
                        {{ $eachbilldiscounthistory->discount_type ? config('archive.discount_type')[$eachbilldiscounthistory->discount_type] : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $eachbilldiscounthistory->bill_type? collect(config('archive.bill_type'))->where('id', $eachbilldiscounthistory->bill_type)->first()['subtype']: '-' }}
                    </td>
                    <td class="text-center">{{ $eachbilldiscounthistory->billdiscountable->uniqid }}</td>
                    <td class="text-center">{{ $eachbilldiscounthistory->discount_amount }}</td>
                    <td class="text-center">{{ $eachbilldiscounthistory->created_at->format('d-m-Y h:i A') }}</td>
                    <td class="text-center">
                        <button wire:click="show({{ $eachbilldiscounthistory->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $billdiscounthistory->firstItem() }} to {{ $billdiscounthistory->lastItem() }} out of
            {{ $billdiscounthistory->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $billdiscounthistory->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    @include('livewire.admin.billing.billdiscount.billdiscounthistory.show')
</div>
