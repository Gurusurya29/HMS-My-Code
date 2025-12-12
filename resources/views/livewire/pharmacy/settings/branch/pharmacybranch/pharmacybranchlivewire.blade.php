<div>
    <x-pharmacy.layouts.pharmacyindex>

        <x-slot name="title">
            BRANCH
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacysettings') }}"
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
                'name' => 'NAME',
                'type' => 'sortby',
                'sortname' => 'branch_name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => auth()->guard('pharmacy')->user()->isAdmin()
                    ? 'VIEW/EDIT'
                    : 'VIEW',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($pharmbranch as $index => $eachpharmbranch)
                <tr>
                    <td>{{ $pharmbranch->firstItem() + $index }}</td>
                    <td>{{ $eachpharmbranch->uniqid }}</td>
                    <td class="text-center">
                        {{ $eachpharmbranch->branch_name }}
                    </td>
                    <td>
                        <button wire:click="show({{ $eachpharmbranch->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        @if (auth()->guard('pharmacy')->user()->isAdmin())
                            <button wire:click="edit({{ $eachpharmbranch->id }})" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-fill"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $pharmbranch->firstItem() }} to {{ $pharmbranch->lastItem() }} out of
            {{ $pharmbranch->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $pharmbranch->links() }}
        </x-slot>

    </x-pharmacy.layouts.pharmacyindex>

    <!-- Create or Edit Modal -->
    @include('livewire.pharmacy.settings.branch.pharmacybranch.createoredit')

    <!-- Show Modal -->
    @include('livewire.pharmacy.settings.branch.pharmacybranch.show')

</div>
