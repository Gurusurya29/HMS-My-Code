<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            LOGIN INFORMATION LOGS
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
                'name' => ' DEVICE / BROWSER / PLATFORM / TYPE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'STATUS',
                'type' => 'sortby',
                'sortname' => 'login_status',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CREATED AT ',
                'type' => 'sortby',
                'sortname' => 'created_at',
            ])

        </x-slot>

        <x-slot name="tablebody">
            @foreach ($logininfo as $index => $eachlogininfo)
                <tr>
                    <td>{{ $logininfo->firstItem() + $index }}</td>
                    <td>
                        {{ $eachlogininfo->logininfoable->uniqid }}
                    </td>
                    <td class="text-center">
                        {{ $eachlogininfo->logininfoable->name }}
                        ({{ ucwords(strtolower($eachlogininfo->logininfoable->usertype)) }})
                    </td>
                    <td> {{ $eachlogininfo->device }} / {{ $eachlogininfo->browser }} /
                        {{ $eachlogininfo->platform }} / {{ $eachlogininfo->type }}
                    </td>
                    <td>{!! $eachlogininfo->login_status
                        ? '<span class="badge bg-success fs-6">Success</span>'
                        : '<span class="badge bg-danger fs-6">Fail</span>' !!}
                    </td>
                    <td>{{ $eachlogininfo->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $logininfo->firstItem() }} to {{ $logininfo->lastItem() }} out of
            {{ $logininfo->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $logininfo->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

</div>
