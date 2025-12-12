<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">OT SCHEDULED LIST</span></div>
                <div class="bd-highlight d-flex gap-1">
                    @can('OT-New_Surgery')
                        <a href="{{ route('otscheduling') }}" class="btn btn-sm btn-primary shadow float-end mx-1">
                            Schedule New Surgery
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="mb-2">
                <div class="row justify-content-between">
                    <div class="col-1">
                        <select wire:click="updatepagination" wire:model.lazy="paginationlength" class="form-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-md-11">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="startdateid" class="col-form-label fw-bold fs-5"> Start Date :
                                        </label>

                                    </div>
                                    <div class="col-auto">
                                        <input type="date" wire:model="from_date" class="form-control"
                                            id="startdateid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="enddateid" class="col-form-label fw-bold fs-5">
                                            End Date : </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" wire:model="to_date" class="form-control" id="enddateid">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-3 float-end">
                                <input wire:model="searchTerm" type="text" class="form-control bg-white"
                                    placeholder="Search...">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="table-responsive">
                <table id="tableid" class="table table-striped table-hover w-100 text-center">
                    <thead class="text-white theme_bg_color">
                        <tr>
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'S.NO',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'UHID',
                                'type' => 'sortby',
                                'sortname' => 'name',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'PATIENT NAME',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'DOCTOR',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'SURGERY NAME',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'START TIME',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'END TIME',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @can('OT-Surgerydetails')
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'SURGERY DETAILS',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                            @endcan
                            @can('OT-Surgerynotes')
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'SURGERY NOTES',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                            @endcan
                            @can('OT-MovetoIP')
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'MOVE TO IP',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                            @endcan
                            @can('OT-View')
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'VIEW',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($otschedulelist as $index => $eachotschedulelist)
                            <tr>
                                <td>{{ $otschedulelist->firstItem() + $index }}</td>
                                <td>{{ $eachotschedulelist->patient->uhid }}</td>
                                <td>{{ $eachotschedulelist->patient->name }}</td>
                                <td>{{ $eachotschedulelist->doctor->name }}</td>
                                <td>{{ $eachotschedulelist->surgery_name }}</td>
                                <td>{{ $eachotschedulelist->surgery_startdate ? date('d-m-Y h:i A', strtotime($eachotschedulelist->surgery_startdate)) : '-' }}
                                </td>
                                <td>{{ $eachotschedulelist->surgery_enddate ? date('d-m-Y h:i A', strtotime($eachotschedulelist->surgery_enddate)) : '-' }}
                                </td>
                                @can('OT-Surgerydetails')
                                    <td>
                                        <a href="{{ route('otscheduling', $eachotschedulelist->uuid) }}"
                                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                                    </td>
                                @endcan
                                @can('OT-Surgerynotes')
                                    <td>
                                        @if ($eachotschedulelist->chief_surgeon)
                                            <a href="{{ route('otpreopnotes', $eachotschedulelist->uuid) }}"
                                                class="btn btn-sm btn-primary m-1">Pre-Op</a>
                                            @if ($eachotschedulelist->otsurgerypreop)
                                                <a href="{{ route('otpostopnotes', $eachotschedulelist->uuid) }}"
                                                    class="btn btn-sm btn-primary m-1">Post-Op</a>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endcan
                                @can('OT-MovetoIP')
                                    <td>
                                        @if ($eachotschedulelist->is_movetoip)
                                            <span class="fw-bold">Patient Moved</span>
                                        @else
                                            <button wire:click="movetoip({{ $eachotschedulelist->id }})"
                                                class="btn btn-sm btn-warning">Move</button>
                                        @endif
                                    </td>
                                @endcan
                                @can('OT-View')
                                    <td>
                                        <button wire:click="show({{ $eachotschedulelist->id }})"
                                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="d-flex bd-highlight">
                    <div class="p-1 bd-highlight"> Showing {{ $otschedulelist->firstItem() }} to
                        {{ $otschedulelist->lastItem() }} out of
                        {{ $otschedulelist->total() }} items</div>
                    <div class="ms-auto p-1 bd-highlight"> {{ $otschedulelist->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.operationtheatre.othistory.show')
    @include('livewire.admin.operationtheatre.otschedule.otmovetoip')

</div>
