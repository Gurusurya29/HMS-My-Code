<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            INSURANCE HISTORY
        </x-slot>

        <x-slot name="action">

        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UHID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PATIENT NAME',
                'type' => 'normal',
                'sortname' => '',
            ])

            @include('helper.tablehelper.tableheader', [
                'name' => 'MOBILE NUMBER',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UPDATE INSURANCE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW',
                'type' => 'normal',
                'sortname' => '',
            ])

        </x-slot>

        <x-slot name="tablebody">
            @foreach ($patientinsurance as $index => $eachpatientinsurance)
                <tr>
                    <td>{{ $patientinsurance->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachpatientinsurance->patient->uhid }}</td>
                    <td class="text-center">{{ $eachpatientinsurance->patient->name }}</td>
                    <td class="text-center">{{ $eachpatientinsurance->patient->phone }}</td>
                    <td>
                        <a href="{{ route('patientinsurance', ['uuid' => $eachpatientinsurance->uuid, 'type' => 'edit']) }}"
                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                    </td>
                    <td>
                        <button type="button" wire:click="show({{ $eachpatientinsurance->id }})"
                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $patientinsurance->firstItem() }} to {{ $patientinsurance->lastItem() }} out of
            {{ $patientinsurance->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $patientinsurance->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>
    @include('livewire.admin.insurance.patientinsurance.patientinsurancehistory.show')
</div>
