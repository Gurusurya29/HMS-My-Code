<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            THEME SETTINGS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
            {{-- <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                data-bs-toggle="modal" data-bs-target="#createoreditModal">
                Create
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
                'name' => 'THEME NAME',
                'type' => 'sortby',
                'sortname' => 'theme_name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'IS DEFAULT',
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
            @foreach ($themesetting as $index => $eachthemesetting)
                <tr>
                    <td>{{ $themesetting->firstItem() + $index }}</td>
                    <td>{{ $eachthemesetting->uniqid }}</td>
                    <td>{{ $eachthemesetting->theme_name }}</td>
                    <td>{!! $eachthemesetting->is_default ? '<span class="badge bg-success fs-6">Yes</span>' : '<span class="badge bg-danger fs-6">No</span>' !!}
                    <td>
                        <button wire:click="show({{ $eachthemesetting->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <button wire:click="edit({{ $eachthemesetting->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-pencil-fill"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $themesetting->firstItem() }} to {{ $themesetting->lastItem() }} out of
            {{ $themesetting->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $themesetting->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

    <!-- Create or Edit Modal -->
    @include(
        'livewire.admin.settings.generalsetting.themesetting.createoredit'
    )

    <!-- Show Modal -->
    @include(
        'livewire.admin.settings.generalsetting.themesetting.show'
    )

</div>
