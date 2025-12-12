<div>
    <x-laboratory.layouts.laboratoryindex>

        <x-slot name="title">
            LABORATORY INVESTIGATION PATIENT LIST
        </x-slot>

        <x-slot name="action">
            {{-- <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('pharmacysettings') }}"
                role="button">Back</a> --}}
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'LAB ID',
                'type' => 'sortby',
                'sortname' => 'uniqid',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UHID',
                'type' => 'sortby',
                'sortname' => 'uhid',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PATIENT NAME',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PHONE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DOCTOR',
                'type' => 'normal',
                'sortname' => '',
            ])

            @include('helper.tablehelper.tableheader', [
                'name' => 'SOURCE',
                'type' => 'normal',
                'sortname' => '',
            ])

            {{-- @include('helper.tablehelper.tableheader', [
                'name' => 'CREATED AT',
                'type' => 'normal',
                'sortname' => '',
            ]) --}}
            {{-- @include('helper.tablehelper.tableheader', [
                'name' => 'INVESTIGATION COUNT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'AMOUNT',
                'type' => 'normal',
                'sortname' => '',
            ]) --}}
            @include('helper.tablehelper.tableheader', [
                'name' => 'MOVE TO BILL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PRINT BILL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SAMPLE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'RESULT ENTRY',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DELIVERY',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SHOW / REPORT PRINT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($labpatient as $index => $eachlabpatient)
                @php
                    $labcount = $eachlabpatient->labpatientlist()->count();
                    
                    $samplecount = $eachlabpatient
                        ->labpatientlist()
                        ->whereNotNull('is_sampletaken')
                        ->count();
                    
                    $resultcount = $eachlabpatient
                        ->labpatientlist()
                        ->whereNotNull('is_resultupdated')
                        ->count();
                    
                    if ($labcount == $resultcount) {
                        $tableclass = 'text-success';
                    } elseif ($labcount == $samplecount) {
                        $tableclass = 'text-primary';
                    } else {
                        $tableclass = 'text-dark';
                    }
                    
                @endphp
                <tr>
                    <td class="{{ $tableclass }} fw-bold">{{ $labpatient->firstItem() + $index }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachlabpatient->uniqid }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachlabpatient->patient?->uhid }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachlabpatient->patient?->name }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachlabpatient->patient?->phone }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachlabpatient->doctor?->name }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachlabpatient->subtype }}</td>
                    {{-- <td>{{ $eachlabpatient->created_at->format('d-m-Y H:s:i') }}</td> --}}

                    {{-- <td>
                        {{ $eachlabpatient->labpatientlist()->count() }}
                    </td>
                    <td>{{ $eachlabpatient->total }}</td> --}}
                    <td>
                        @if (!$eachlabpatient->is_billgenerated)
                            <a href="{{ route('labpatientmovetobill', ['uuid' => $eachlabpatient->uuid]) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-receipt text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($eachlabpatient->is_billgenerated)
                            <a href="{{ route('labbillingprint', ['uuid' => $eachlabpatient->uuid]) }}"
                                target="_blank" class="btn btn-sm btn-primary"><i
                                    class="bi bi-currency-dollar text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if ($eachlabpatient->is_billgenerated)
                            <a href="{{ route('labsample', ['uuid' => $eachlabpatient->uuid]) }}"
                                class="btn btn-sm btn-success position-relative">
                                <i class="bi bi-journal-plus text-white"></i>
                                @if ($eachlabpatient->is_emergency)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                        <span class="visually-hidden"></span>
                                    </span>
                                @endif
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($eachlabpatient->labpatientlist->where('is_sampletaken', true)->count() > 0)
                            <a href="{{ route('labresultentry', ['uuid' => $eachlabpatient->uuid]) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-bootstrap-reboot text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($eachlabpatient->labpatientlist->where('is_resultupdated', true)->count() > 0)
                            <a href="{{ route('labdelivery', ['uuid' => $eachlabpatient->uuid]) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-envelope-check text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a wire:click="show({{ $eachlabpatient->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-eye text-white"></i></a>

                        @if ($eachlabpatient->labpatientlist->where('is_resultupdated', true)->count() > 0)
                            <a target="_blank" href="{{ route('labprint', ['uuid' => $eachlabpatient->uuid]) }}"
                                class="btn btn-sm btn-secondary"><i class="bi bi-printer text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $labpatient->firstItem() }} to {{ $labpatient->lastItem() }} out of
            {{ $labpatient->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $labpatient->links() }}
        </x-slot>

    </x-laboratory.layouts.laboratoryindex>
</div>
<
    @include('livewire.laboratory.laboratory.patientlist.show')
