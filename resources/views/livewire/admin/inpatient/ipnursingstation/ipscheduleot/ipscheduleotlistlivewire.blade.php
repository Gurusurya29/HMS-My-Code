<div class="card-body bg-light">
    @include('livewire.admin.inpatient.common.inpatientregistrationdetails')
    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color py-1 px-2">
                <div class="d-flex flex-row bd-highlight align-items-center">
                    <div class="flex-grow-1 bd-highlight">OT SCHEDULE HISTORY</div>
                    <div class="bd-highlight d-flex gap-1">
                        <a href="{{ route('ipscheduleot', $inpatient->uuid) }}"
                            class="btn btn-sm btn-primary shadow float-end mx-1">
                            Schedule New Surgery
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="clearfix">
                    <div class="col-md-1 float-start">
                        <select wire:click="updatepagination" wire:model="paginationlength" class="form-select"
                            aria-label="Default select example">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="mb-2 col-md-3 float-end">
                        <input wire:model="searchTerm" type="text" class="form-control bg-white"
                            placeholder="Search...">
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
                                    'name' => 'UNIQID',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'SURGERY NAME',
                                    'type' => 'sortby',
                                    'sortname' => 'surgery_name',
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
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'STATUS',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'VIEW/EDIT',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($otschedulelist as $index => $eachiotschedulelist)
                                <tr>
                                    <td>{{ $otschedulelist->firstItem() + $index }}</td>
                                    <td>{{ $eachiotschedulelist->uniqid }}</td>
                                    <td>{{ $eachiotschedulelist->surgery_name }}</td>
                                    <td>{{ $eachiotschedulelist->surgery_startdate ? date('d-m-Y h:i A', strtotime($eachiotschedulelist->surgery_startdate)) : '-' }}
                                    </td>
                                    <td>{{ $eachiotschedulelist->surgery_enddate ? date('d-m-Y h:i A', strtotime($eachiotschedulelist->surgery_enddate)) : '-' }}
                                    </td>
                                    <td>
                                        @include('admin.common.datatable.activestatus', [
                                            'status' => $eachiotschedulelist->is_otactive,
                                        ])
                                    </td>
                                    <td>
                                        <button wire:click="show({{ $eachiotschedulelist->id }})"
                                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                                        @if (empty($eachiotschedulelist->is_movedto_ot))
                                            <a href="{{ route('ipscheduleot', [$inpatient->uuid, $eachiotschedulelist->uuid]) }}"
                                                class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="d-flex bd-highlight">
                        <div class="p-1 bd-highlight"> Showing {{ $otschedulelist->firstItem() }} to
                            {{ $otschedulelist->lastItem() }} out
                            of
                            {{ $otschedulelist->total() }} items</div>
                        <div class="ms-auto p-1 bd-highlight"> {{ $otschedulelist->links() }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('livewire.admin.operationtheatre.othistory.show')
</div>
