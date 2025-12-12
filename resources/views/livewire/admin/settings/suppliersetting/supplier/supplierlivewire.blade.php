<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            SUPPLIER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-supplier')
                @livewire('admin.settings.suppliersetting.supplier.createoredit.suppliercreatelivewire')
            @endcan
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
                'name' => 'SUPPLIER COMPANY NAME',
                'type' => 'sortby',
                'sortname' => 'company_person_name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'COMPANY NAME',
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
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-supplier')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-supplier')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
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
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachsupplier->active,
                        ])
                    </td>
                    @can('View-supplier')
                        <td>
                            <button wire:click="show({{ $eachsupplier->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-supplier')
                        <td>
                            <button wire:click="edit({{ $eachsupplier->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

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

    </x-admin.layouts.adminindex>

    <!-- Show Modal -->
    @include('livewire.pharmacy.settings.supplier.pharmacysupplier.show')

</div>
