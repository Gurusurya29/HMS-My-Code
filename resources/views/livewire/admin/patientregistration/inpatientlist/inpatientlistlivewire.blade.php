<div>
    <x-admin.layouts.adminindex>

        <x-slot name="title">
            IN PATIENT LIST
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
                'name' => 'DOCTOR',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'WARD',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'FLOOR',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'ROOM',
                'type' => 'normal',
                'sortname' => '',
            ])

        </x-slot>

        <x-slot name="tablebody">
            @foreach ($inpatientlist as $index => $eachinpatient)
                <tr>
                    <td>{{ $inpatientlist->firstItem() + $index }}</td>
                    <td>{{ $eachinpatient->patient->uhid }}</td>
                    <td>{{ $eachinpatient->patient->name }}</td>
                    <td>{{ $eachinpatient->patient->phone }}</td>
                    <td>{{ $eachinpatient->patientvisit->doctor->name }}</td>
                    <td>{{ $eachinpatient->wardtype->name }}</td>
                    <td> {{ $eachinpatient->bedorroomnumber->wardfloor->name }}</td>
                    <td> {{ $eachinpatient->bedorroomnumber->name }}</td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $inpatientlist->firstItem() }} to {{ $inpatientlist->lastItem() }} out of
            {{ $inpatientlist->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $inpatientlist->links() }}
        </x-slot>

    </x-admin.layouts.adminindex>

</div>
