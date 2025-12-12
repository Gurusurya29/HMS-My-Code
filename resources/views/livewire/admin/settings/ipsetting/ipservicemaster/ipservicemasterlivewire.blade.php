<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            IP BILLING SERVICE
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-ipbillingservices')
                <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                    data-bs-toggle="modal" data-bs-target="#createoreditModal">
                    Add
                </button>
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
                'name' => 'NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CATEGORY',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-ipbillingservices')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-ipbillingservices')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($ipservicemaster as $index => $eachipservicemaster)
                <tr>
                    <td>{{ $ipservicemaster->firstItem() + $index }}</td>
                    <td>{{ $eachipservicemaster->uniqid }}</td>
                    <td class="text-center">{{ $eachipservicemaster->name }}</td>
                    <td class="text-center">{{ $eachipservicemaster->ipservicecategory->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachipservicemaster->active,
                        ])
                    </td>
                    @can('View-ipbillingservices')
                        <td>
                            <button wire:click="show({{ $eachipservicemaster->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-ipbillingservices')
                        <td>
                            <button wire:click="edit({{ $eachipservicemaster->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $ipservicemaster->firstItem() }} to {{ $ipservicemaster->lastItem() }} out of
            {{ $ipservicemaster->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $ipservicemaster->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.ipsetting.ipservicemaster.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.ipsetting.ipservicemaster.show')

</div>
