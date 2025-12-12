<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            DOCTOR CONSULTATION FEE
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                data-bs-toggle="modal" data-bs-target="#createoreditModal">
                Add Fee
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
                'name' => 'DOCTOR NAME',
                'type' => 'sortby',
                'sortname' => 'doctor_id',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SPECIALIZATION',
                'type' => 'sortby',
                'sortname' => 'doctorspecialization_id',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'INSURANCE FEE',
                'type' => 'sortby',
                'sortname' => 'insurancefee',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SELF FEE',
                'type' => 'sortby',
                'sortname' => 'selffee',
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
            @foreach ($doctorconsultationfee as $index => $eachdoctorconsultationfee)
                <tr>
                    <td>{{ $doctorconsultationfee->firstItem() + $index }}</td>
                    <td>{{ $eachdoctorconsultationfee->uniqid }}</td>
                    <td class="text-center">{{ $eachdoctorconsultationfee->doctor->name }}</td>
                    <td class="text-center">{{ $eachdoctorconsultationfee->doctorspecialization->name }}</td>
                    <td class="text-center">{{ $eachdoctorconsultationfee->insurancefee }}</td>
                    <td class="text-center">{{ $eachdoctorconsultationfee->selffee }}</td>
                    <td>
                        @include('admin.common.datatable.activestatus', [
                            'status' => $eachdoctorconsultationfee->active,
                        ])
                    </td>
                    <td>
                        <button wire:click="show({{ $eachdoctorconsultationfee->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                        <button wire:click="edit({{ $eachdoctorconsultationfee->id }})"
                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $doctorconsultationfee->firstItem() }} to {{ $doctorconsultationfee->lastItem() }} out of
            {{ $doctorconsultationfee->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $doctorconsultationfee->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include('livewire.admin.settings.doctorsetting.doctorconsultationfee.createoredit')

    <!-- Show Modal -->
    @include('livewire.admin.settings.doctorsetting.doctorconsultationfee.show')

</div>
