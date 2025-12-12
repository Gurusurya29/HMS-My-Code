<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            HMS Prescription
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacy.salesentrycreate') }}"
                role="button">Back</a>
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
                'name' => 'PHONE NO.',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'EMERGENCY',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PHARMACY PROCCESSED',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'MOVE TO SALE',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($prescription as $index => $eachprescription)
                <tr>
                    <td>{{ $prescription->firstItem() + $index }}</td>
                    <td>{{ $eachprescription->uniqid }}</td>
                    <td>{{ $eachprescription->patient->uhid }}</td>
                    <td>{{ $eachprescription->patient->name }}</td>
                    <td>{{ $eachprescription->patient->phone }}</td>
                    <td>
                        @if ($eachprescription->is_emergency && !$eachprescription->ispharm_proccessed)
                            <i class="bi bi-circle-fill" style="color:#ff0000"></i>
                        @else
                            <i class="bi bi-circle-fill" style="color:#00b600"></i>
                        @endif
                    </td>
                    <td>
                        @if (!$eachprescription->ispharm_proccessed)
                            <i class="bi bi-circle-fill" style="color:#ff0000"></i>
                        @else
                            <i class="bi bi-circle-fill" style="color:#00b600"></i>
                        @endif
                    </td>
                    <td>
                        <button wire:click="show({{ $eachprescription->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                    </td>
                    <td>
                        <a href="{{ route('pharmacy.salesentrycreate', ['prescriptionuuid' => $eachprescription->uuid]) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $prescription->firstItem() }} to {{ $prescription->lastItem() }} out of
            {{ $prescription->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $prescription->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    @include('livewire.pharmacy.sales.prescription.show')
</div>
