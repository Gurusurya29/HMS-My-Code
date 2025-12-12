<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            OT BILLING
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

            @can('Otbill')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'BILLING',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Otpaybill')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'PAY BILL',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($otbilling as $index => $eachotbilling)
                <tr>
                    <td>{{ $otbilling->firstItem() + $index }}</td>
                    <td>{{ $eachotbilling->uniqid }}</td>
                    <td class="text-center">{{ $eachotbilling->patient->uhid }}</td>
                    <td class="text-center">{{ $eachotbilling->patientvisit->uniqid }}</td>
                    <td class="text-center">{{ $eachotbilling->patient->name }}</td>
                    <td class="text-center">{{ $eachotbilling->patient->phone }}</td>
                    @can('Otbill')
                        <td>
                            <a href="{{ route('otbillingservice', $eachotbilling->uuid) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-clipboard-plus"></i></a>
                        </td>
                    @endcan
                    @can('Otpaybill')
                        <td>
                            <a href="{{ route('otbillpayment', $eachotbilling->uuid) }}" class="btn btn-sm btn-info"><i
                                    class="bi bi-receipt"></i></a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $otbilling->firstItem() }} to {{ $otbilling->lastItem() }} out of
            {{ $otbilling->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $otbilling->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

</div>
