<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            PURCHASE ORDER
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-primary shadow float-end mx-1" href="{{ route('pharmacy.salesreturncreate') }}"
                style="width:100px;" role="button">ADD</a>
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
            'name' => 'S.NO',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'PATIENT PHONE NO.',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'PATIENT NAME',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'SALES ID',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'RETURN DATE',
            'type' => 'normal',
            'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
            'name' => 'VIEW/PRINT',
            'type' => 'normal',
            'sortname' => '',
            ])
        </x-slot>

        <x-slot name="nostrip">
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($salesreturn as $index => $eachsalesreturn)
            <tr>
                <td>{{ $salesreturn->firstItem() + $index }}</td>
                <td>{{ $eachsalesreturn->patient->phone }}</td>
                <td>{{ $eachsalesreturn->patient->name }}</td>
                <td>
                    {{ $eachsalesreturn->pharmsalesentry->uniqid }}
                </td>
                <td>{{ Carbon\Carbon::parse($eachsalesreturn->created_at)->format('d-m-Y') }}</td>
                <td>
                    <button wire:click="show({{ $eachsalesreturn->id }})" class="btn btn-sm btn-success"><i
                            class="bi bi-eye-fill"></i></button>
                    <button wire:click="printsalesreturn({{ $eachsalesreturn->id }})" class="btn btn-sm btn-success"><i
                            class="bi bi-printer"></i></button>
                </td>
            </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $salesreturn->firstItem() }} to {{ $salesreturn->lastItem() }} out of
            {{ $salesreturn->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $salesreturn->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    {{-- SHOW --}}
    @include('livewire.pharmacy.sales.salesreturn.show')
</div>