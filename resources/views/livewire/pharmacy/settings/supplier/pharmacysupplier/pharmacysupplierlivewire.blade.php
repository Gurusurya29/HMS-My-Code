<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PHARMACY SUPPLIER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacysettings') }}"
                role="button">Back</a>
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
                'name' => 'CONTACT PERSON NAME',
                'type' => 'sortby',
                'sortname' => 'company_person_name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SUPPIER COMPANY NAME',
                'type' => 'sortby',
                'sortname' => 'company_name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'MOBILE NUMBER',
                'type' => 'sortby',
                'sortname' => 'contact_mobile_no',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PHONE NUMBER',
                'type' => 'sortby',
                'sortname' => 'contact_phone_no',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PRODUCT COUNT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
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
                    'name' => 'PRODUCTS',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endif
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($supplier as $index => $eachsupplier)
                <tr>
                    <td>{{ $supplier->firstItem() + $index }}</td>
                    <td>{{ $eachsupplier->uniqid }}</td>
                    <td>{{ $eachsupplier->company_person_name }}</td>
                    <td>{{ $eachsupplier->company_name }}</td>
                    <td>{{ $eachsupplier->contact_mobile_no }}</td>
                    <td>{{ $eachsupplier->contact_phone_no }}</td>
                    <td>{{ $eachsupplier->gettotalproductunderthem() }}</td>
                    <td>
                        @include('pharmacy.common.datatable.activestatus', [
                            'status' => $eachsupplier->active,
                        ])
                    </td>
                    <td>
                        <button wire:click="show({{ $eachsupplier->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                    </td>
                    @if (auth()->guard('pharmacy')->user()->isAdmin())
                        <td>
                            <a href="{{ route('pharmacymapsupplierproduct', $eachsupplier->uuid) }}"
                                class="btn btn-sm btn-warning"><i class="bi bi-box text-white"></i></a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $supplier->firstItem() }} to {{ $supplier->lastItem() }} out of
            {{ $supplier->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $supplier->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    <!-- Show Modal -->
    @include('livewire.pharmacy.settings.supplier.pharmacysupplier.show')

</div>
