<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            Country
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('Add-country')
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
                'name' => 'COUNTRY CODE',
                'type' => 'sortby',
                'sortname' => 'code',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'NAME',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-country')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-country')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($country as $index => $eachcountry)
                <tr>
                    <td>{{ $country->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachcountry?->code }}</td>
                    <td class="text-center">{{ $eachcountry->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachcountry->active,
                        ])
                    </td>
                    @can('View-country')
                        <td>
                            <button wire:click="show({{ $eachcountry->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-country')
                        <td>
                            <button wire:click="edit({{ $eachcountry->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $country->firstItem() }} to {{ $country->lastItem() }} out of
            {{ $country->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $country->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.patientregisterationsetting.country.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.patientregisterationsetting.country.show')

</div>
