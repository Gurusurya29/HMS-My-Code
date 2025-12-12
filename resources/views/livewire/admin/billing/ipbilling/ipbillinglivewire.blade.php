<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            IP BILLING
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
            @can('Ipbill')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'BILLING',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Ippaybill')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'PAY BILL',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($ipbilling as $index => $eachpatient)
                <tr>
                    <td>{{ $ipbilling->firstItem() + $index }}</td>
                    <td>{{ $eachpatient->uniqid }}</td>
                    <td class="text-center">{{ $eachpatient->patient->uhid }}</td>
                    <td class="text-center">{{ $eachpatient->patientvisit->uniqid }}</td>
                    <td class="text-center">{{ $eachpatient->patient->name }}</td>
                    <td class="text-center">{{ $eachpatient->patient->phone }}</td>
                    @can('Ipbill')
                        <td>
                            <a href="{{ route('ipbillingservice', $eachpatient->uuid) }}" class="btn btn-sm btn-primary"><i
                                    class="bi bi-clipboard-plus"></i></a>
                        </td>
                    @endcan
                    @can('Ippaybill')
                        <td>
                            <a href="{{ route('ipbillpayment', $eachpatient->uuid) }}" class="btn btn-sm btn-info"><i
                                    class="bi bi-receipt"></i></a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $ipbilling->firstItem() }} to {{ $ipbilling->lastItem() }} out of
            {{ $ipbilling->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $ipbilling->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

</div>
