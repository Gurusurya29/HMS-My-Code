<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            OP BILLING
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
                'name' => 'UHID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VISIT ID',
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
                'name' => 'TOTAL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'TYPE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('Opbill')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'BILLING',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Oppaybill')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'PAY BILL',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($opbilling as $index => $eachopbilling)
                <tr>
                    <td>{{ $opbilling->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachopbilling->patient->uhid }}</td>
                    <td class="text-center">{{ $eachopbilling->patientvisit->uniqid }}</td>
                    <td class="text-center">{{ $eachopbilling->patient->name }}</td>
                    <td class="text-center">{{ $eachopbilling->patient->phone }}</td>
                    <td class="text-center">{{ $eachopbilling->opbillinglist->sum('grand_total') }}</td>
                    <td class="text-center">
                        @if ($eachopbilling->billing_type == 1)
                            SELF
                        @elseif ($eachopbilling->billing_type == 2)
                            INS
                        @elseif ($eachopbilling->billing_type == 3)
                            CORP
                        @else
                            -
                        @endif
                    </td>
                    @can('Opbill')
                        <td>
                            <a href="{{ route('opbillingaddservice', $eachopbilling->uuid) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-clipboard-plus"></i></a>
                        </td>
                    @endcan
                    @can('Oppaybill')
                        <td>
                            <a href="{{ route('opbillpayment', $eachopbilling->uuid) }}" class="btn btn-sm btn-primary"><i
                                    class="bi bi-receipt"></i></a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $opbilling->firstItem() }} to {{ $opbilling->lastItem() }} out of
            {{ $opbilling->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $opbilling->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>



</div>
