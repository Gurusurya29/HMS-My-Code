<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            FACILITY
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('facility') }}"
                role="button">Back</a>
            @can('Add-Facility')
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
                'name' => 'LOCATION',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'ASSET CUSTODIAN',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-Facility')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-Facility')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($facility as $index => $eachfacility)
                <tr>
                    <td>{{ $facility->firstItem() + $index }}</td>
                    <td>{{ $eachfacility->uniqid }}</td>
                    <td class="text-center">{{ $eachfacility->name }}</td>
                    <td class="text-center">{{ $eachfacility->location ?? '-' }}</td>
                    <td class="text-center">{{ $eachfacility->asset_custodian ?? '-' }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachfacility->active,
                        ])
                    </td>
                    @can('View-Facility')
                        <td>
                            <button wire:click="show({{ $eachfacility->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-Facility')
                        <td>
                            <button wire:click="edit({{ $eachfacility->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $facility->firstItem() }} to {{ $facility->lastItem() }} out of
            {{ $facility->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $facility->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.facility.facilitymaster.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.facility.facilitymaster.show')

</div>
