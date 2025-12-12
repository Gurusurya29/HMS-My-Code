<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            DOCTOR SPECIALIZATION
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            {{-- <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                data-bs-toggle="modal" data-bs-target="#createoreditModal">
                Add Specialization
            </button> --}}
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
                'name' => 'VIEW',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($doctorspecialization as $index => $eachdoctorspecialization)
                <tr>
                    <td>{{ $doctorspecialization->firstItem() + $index }}</td>
                    <td>{{ $eachdoctorspecialization->uniqid }}</td>
                    <td class="text-center">{{ $eachdoctorspecialization->name }}</td>
                    <td>
                        <button wire:click="show({{ $eachdoctorspecialization->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        {{-- <button wire:click="edit({{ $eachdoctorspecialization->id }})"
                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button> --}}
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $doctorspecialization->firstItem() }} to {{ $doctorspecialization->lastItem() }} out of
            {{ $doctorspecialization->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $doctorspecialization->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.doctorsetting.doctorspecialization.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.doctorsetting.doctorspecialization.show')

</div>
