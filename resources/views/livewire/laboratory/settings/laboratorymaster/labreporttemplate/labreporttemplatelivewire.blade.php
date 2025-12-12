<div>
    <x-laboratory.layouts.laboratoryindex>

        <x-slot name="title">
            REPORT TEMPLATE
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('laboratorysettings') }}"
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
                'name' => 'VIEW/EDIT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($labreporttemplate as $index => $eachlabreporttemplate)
                <tr>
                    <td>{{ $labreporttemplate->firstItem() + $index }}</td>
                    <td>{{ $eachlabreporttemplate->uniqid }}</td>
                    <td class="text-center">{{ $eachlabreporttemplate->name }}</td>
                    <td>
                        <button wire:click="show({{ $eachlabreporttemplate->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>

                        <button wire:click="edit({{ $eachlabreporttemplate->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-pencil-fill"></i></button>

                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $labreporttemplate->firstItem() }} to {{ $labreporttemplate->lastItem() }} out of
            {{ $labreporttemplate->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $labreporttemplate->links() }}
        </x-slot>

    </x-laboratory.layouts.laboratoryindex>

    <!-- Create or Edit Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labreporttemplate.createoredit')

    <!-- Show Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labreporttemplate.show')

</div>
