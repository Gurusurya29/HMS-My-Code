<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            BED OR ROOM NUMBER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            @can('View-bed/roomnumber')
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
                'name' => 'WARD TYPE',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'WARD FLOOR / BLOCK',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'ROOM NUMBER',
                'type' => 'sortby',
                'sortname' => 'name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'OT BED/ROOM',
                'type' => 'normal',
                'sortname' => '',
            ])
            @can('View-bed/roomnumber')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'VIEW',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
            @can('Edit-bed/roomnumber')
                @include('helper.tablehelper.tableheader', [
                    'name' => 'EDIT',
                    'type' => 'normal',
                    'sortname' => '',
                ])
            @endcan
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($bedorroomnumber as $index => $eachbedorroomnumber)
                <tr>
                    <td>{{ $bedorroomnumber->firstItem() + $index }}</td>
                    <td>{{ $eachbedorroomnumber->uniqid }}</td>
                    <td class="text-center">{{ $eachbedorroomnumber->wardtype->name }}</td>
                    <td class="text-center">{{ $eachbedorroomnumber->wardfloor->name }}</td>
                    <td class="text-center">{{ $eachbedorroomnumber->name }}</td>
                    </td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachbedorroomnumber->active,
                        ])
                    </td>

                    <td class="text-center">{{ $eachbedorroomnumber->is_ot ? 'OT' : '-' }}</td>
                    @can('View-bed/roomnumber')
                        <td>
                            <button wire:click="show({{ $eachbedorroomnumber->id }})" class="btn btn-sm btn-success"><i
                                    class="bi bi-eye-fill"></i></button>
                        </td>
                    @endcan
                    @can('Edit-bed/roomnumber')
                        <td>
                            <button wire:click="edit({{ $eachbedorroomnumber->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i></button>
                        </td>
                    @endcan

                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $bedorroomnumber->firstItem() }} to {{ $bedorroomnumber->lastItem() }} out of
            {{ $bedorroomnumber->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $bedorroomnumber->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.wardsetting.bedorroomnumber.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.wardsetting.bedorroomnumber.show')

</div>
