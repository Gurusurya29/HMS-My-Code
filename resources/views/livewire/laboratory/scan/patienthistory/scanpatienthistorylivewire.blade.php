<div>
    <x-laboratory.layouts.laboratoryindex>

        <x-slot name="title">
            SCAN INVESTIGATION PATIENT LIST
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
                'name' => 'UNIQID',
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
            @foreach ($scanpatient as $index => $eachscanpatient)
                @php
                    $scancount = $eachscanpatient->scanpatientlist()->count();
                    
                    $samplecount = $eachscanpatient
                        ->scanpatientlist()
                        ->whereNotNull('is_sampletaken')
                        ->count();
                    
                    $resultcount = $eachscanpatient
                        ->scanpatientlist()
                        ->whereNotNull('is_resultupdated')
                        ->count();
                    
                    if ($scancount == $resultcount) {
                        $tableclass = 'text-success';
                    } elseif ($scancount == $samplecount) {
                        $tableclass = 'text-primary';
                    } else {
                        $tableclass = 'text-dark';
                    }
                    
                @endphp
                <tr>
                    <td class="{{ $tableclass }} fw-bold">{{ $scanpatient->firstItem() + $index }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachscanpatient->uniqid }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachscanpatient->patient?->uhid }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachscanpatient->patient?->name }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachscanpatient->patient?->phone }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachscanpatient->doctor?->name }}</td>
                    <td class="{{ $tableclass }} fw-bold">{{ $eachscanpatient->subtype }}</td>
                    {{-- <td>{{ $eachscanpatient->created_at->format('d-m-Y H:s:i') }}</td> --}}

                    {{-- <td>
                        {{ $eachscanpatient->scanpatientlist()->count() }}
                    </td>
                    <td>{{ $eachscanpatient->total }}</td> --}}
                    {{-- <td>
                        <a href="{{ route('scanbillingprint', ['uuid' => $eachscanpatient->uuid]) }}" target="_blank"
                            class="btn btn-sm btn-primary"><i class="bi bi-currency-dollar text-white"></i></a>
                    </td>
                    <td> --}}

                    <td>
                        @if (!$eachscanpatient->is_billgenerated)
                            <a href="{{ route('scanpatientmovetobill', ['uuid' => $eachscanpatient->uuid]) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-receipt text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($eachscanpatient->is_billgenerated)
                            <a href="{{ route('scanbillingprint', ['uuid' => $eachscanpatient->uuid]) }}"
                                target="_blank" class="btn btn-sm btn-primary"><i
                                    class="bi bi-currency-dollar text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if ($eachscanpatient->is_billgenerated)
                            <a href="{{ route('scansample', ['uuid' => $eachscanpatient->uuid]) }}"
                                class="btn btn-sm btn-success position-relative">
                                <i class="bi bi-journal-plus text-white"></i>
                                @if ($eachscanpatient->is_emergency)
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
                        @if ($eachscanpatient->scanpatientlist->where('is_sampletaken', true)->count() > 0)
                            <a href="{{ route('scanresultentry', ['uuid' => $eachscanpatient->uuid]) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-bootstrap-reboot text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($eachscanpatient->scanpatientlist->where('is_resultupdated', true)->count() > 0)
                            <a href="{{ route('scandelivery', ['uuid' => $eachscanpatient->uuid]) }}"
                                class="btn btn-sm btn-primary"><i class="bi bi-envelope-check text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a wire:click="show({{ $eachscanpatient->id }})" class="btn btn-sm btn-primary"><i
                                class="bi bi-eye text-white"></i></a>

                        @if ($eachscanpatient->scanpatientlist->where('is_resultupdated', true)->count() > 0)
                            <a target="_blank" href="{{ route('scanprint', ['uuid' => $eachscanpatient->uuid]) }}"
                                class="btn btn-sm btn-secondary"><i class="bi bi-printer text-white"></i></a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot>
        <x-slot name="tablerecordtotal">
            Showing {{ $scanpatient->firstItem() }} to {{ $scanpatient->lastItem() }} out of
            {{ $scanpatient->total() }} items
        </x-slot>

        <x-slot name="pagination">
            {{ $scanpatient->links() }}
        </x-slot>

    </x-laboratory.layouts.laboratoryindex>

    <!-- Show Modal -->
    @include('livewire.laboratory.scan.patientlist.show')


</div>
