<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PURCHASE PLANNING
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-primary shadow float-end mx-1" style="width:100px;"
                href="{{ route('pharmacy.pruchaseplanningcreateoredit') }}" role="button">Add Plan</a>
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
                'name' => 'TOTAL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW',
                'type' => 'normal',
                'sortname' => '',
            ])
            @if (auth()->guard('pharmacy')->user()->isAdmin())
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endif
            @include('helper.tablehelper.tableheader', [
                'name' => 'FINALIZE TO PO',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($pharmplanning as $index => $eachpharmplanning)
                <tr>
                    <td>{{ $pharmplanning->firstItem() + $index }}</td>
                    <td>{{ $eachpharmplanning->uniqid }}</td>
                    <td>
                        {{ $eachpharmplanning->supplier_companyname }}
                    </td>
                    <td>{{ $eachpharmplanning->supplier_mobile_no }}</td>
                    <td>{{ $eachpharmplanning->supplier_contact_name }}</td>
                    <td>{{ Carbon\Carbon::parse($eachpharmplanning->planning_date)->format('d-m-Y') }}</td>
                    <td>{{ $eachpharmplanning->grand_total }}</td>
                    <td>
                        <button wire:click="show({{ $eachpharmplanning->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                    </td>
                    @if (auth()->guard('pharmacy')->user()->isAdmin())
                        <td>
                            @if ($eachpharmplanning->po_status == false)
                                <a href="{{ route('pharmacy.pruchaseplanningcreateoredit', ['purchaseplanninguuid' => $eachpharmplanning->uuid]) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            @else
                                <span class="text-center text-danger">Moved to PO</span>
                            @endif
                        </td>
                    @endif
                    <td>
                        @livewire('pharmacy.purchase.purchaseplanning.planningtopovlivewire', ['pharmplanningid' => $eachpharmplanning->id], key($eachpharmplanning->id))
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmplanning->firstItem() }} to {{ $pharmplanning->lastItem() }} out of
            {{ $pharmplanning->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmplanning->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    @include('livewire.pharmacy.purchase.purchaseplanning.show')
</div>
