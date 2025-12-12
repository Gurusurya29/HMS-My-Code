<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            TRACKING LOGS
        </x-slot>

        <x-slot name="action">
            <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('settings') }}"
                role="button">Back</a>
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'sortby',
                'sortname' => 'created_at',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UNIQID',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'NAME',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DETAILS',
                'type' => 'sortby',
                'sortname' => 'trackmsg',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CREATED AT ',
                'type' => 'sortby',
                'sortname' => 'created_at',
            ])

        </x-slot>

        <x-slot name="tablebody">
            @foreach ($tracking as $index => $eachtracking)
                <tr>
                    <td>{{ $tracking->firstItem() + $index }}</td>
                    <td>
                        {{ $eachtracking->trackable->uniqid }}
                    </td>
                    <td class="text-center">
                        {{ $eachtracking->trackable->name }}
                        ({{ ucwords(strtolower($eachtracking->trackable->usertype)) }})
                    </td>
                    <td class="text-center"> {{ $eachtracking->trackmsg }} </td>
                    <td>{{ $eachtracking->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $tracking->firstItem() }} to {{ $tracking->lastItem() }} out of
            {{ $tracking->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $tracking->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

</div>
