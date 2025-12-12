<div>
    <x-laboratory.layouts.laboratoryindex>

        <x-slot name="title">
            TEST METHOD
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1"
                href="{{ $this->currentuser()->usertype == 'ADMIN' ? route('settings') : route('laboratorysettings') }}"
                role="button">Back</a>
            <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                data-bs-toggle="modal" data-bs-target="#createoreditModal">
                Add
            </button>
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
                'name' => 'STATUS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/EDIT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($labtestmethod as $index => $eachlabtestmethod)
                <tr>
                    <td>{{ $labtestmethod->firstItem() + $index }}</td>
                    <td>{{ $eachlabtestmethod->uniqid }}</td>
                    <td class="text-center">{{ $eachlabtestmethod->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachlabtestmethod->active,
                        ])
                    </td>
                    <td>
                        <button wire:click="show({{ $eachlabtestmethod->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>

                        <button wire:click="edit({{ $eachlabtestmethod->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-pencil-fill"></i></button>

                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $labtestmethod->firstItem() }} to {{ $labtestmethod->lastItem() }} out of
            {{ $labtestmethod->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $labtestmethod->links() }}
        </x-slot>

    </x-laboratory.layouts.laboratoryindex>

    <!-- Create or Edit Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labtestmethod.createoredit')

    <!-- Show Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labtestmethod.show')

</div>
