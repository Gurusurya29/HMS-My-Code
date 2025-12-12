<div>
    <x-laboratory.layouts.laboratoryindex>

        <x-slot name="title">
            INVESTIGATION
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
                'name' => 'INVESTIGATION GROUP',
                'type' => 'normal',
                'sortname' => '',
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
            @foreach ($labinvestigation as $index => $eachlabinvestigation)
                <tr>
                    <td>{{ $labinvestigation->firstItem() + $index }}</td>
                    <td>{{ $eachlabinvestigation->uniqid }}</td>
                    <td class="text-center">{{ $eachlabinvestigation->name }}</td>
                    <td class="text-center">{{ $eachlabinvestigation->labinvestigationgroup->name }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachlabinvestigation->active,
                        ])
                    </td>
                    <td>
                        <button wire:click="show({{ $eachlabinvestigation->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>

                        <button wire:click="edit({{ $eachlabinvestigation->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-pencil-fill"></i></button>

                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $labinvestigation->firstItem() }} to {{ $labinvestigation->lastItem() }} out of
            {{ $labinvestigation->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $labinvestigation->links() }}
        </x-slot>

    </x-laboratory.layouts.laboratoryindex>

    <!-- Create or Edit Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labinvestigation.createoredit')

    <!-- Show Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labinvestigation.show')

</div>
