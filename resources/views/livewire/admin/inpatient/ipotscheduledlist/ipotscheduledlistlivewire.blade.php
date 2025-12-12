<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color d-flex justify-content-between">
            <div class="h5 mb-0">
                OT DETAILS | #{{ $inpatient->uniqid }}</div>
            <div class="h5 mb-0">
                <span class="text-warning fw-bold">NAME :</span> {{ $inpatient->patient->name }}
                |
                <span class="text-warning fw-bold">UHID :</span> {{ $inpatient->patient->uhid }}|

                <span class="text-warning fw-bold">PHONE :</span>
                {{ $inpatient->patient->phone }}
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
                    <input wire:model="searchTerm" type="text" class="form-control bg-white" placeholder="Search...">
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
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'STATUS',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'VIEW',
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ipotscheduledlist as $index => $eachipotscheduledlist)
                            <tr>
                                <td>{{ $ipotscheduledlist->firstItem() + $index }}</td>
                                <td>{{ $eachipotscheduledlist->surgery_name }}</td>
                                <td>{{ $eachipotscheduledlist->surgery_startdate ? date('d-m-Y h:i A', strtotime($eachipotscheduledlist->surgery_startdate)) : '-' }}
                                </td>
                                <td>{{ $eachipotscheduledlist->surgery_enddate ? date('d-m-Y h:i A', strtotime($eachipotscheduledlist->surgery_enddate)) : '-' }}
                                </td>
                                <td>
                                    @if ($eachipotscheduledlist->is_movetoip)
                                        <div class="text-primary fw-bold fs-5">
                                            Completed
                                        </div>
                                    @else
                                        @include('admin.common.datatable.activestatus', [
                                            'status' => $eachipotscheduledlist->is_otactive,
                                        ])
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="show({{ $eachipotscheduledlist->id }})"
                                        class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="d-flex bd-highlight">
                    <div class="p-1 bd-highlight"> Showing {{ $ipotscheduledlist->firstItem() }} to
                        {{ $ipotscheduledlist->lastItem() }} out of
                        {{ $ipotscheduledlist->total() }} items</div>
                    <div class="ms-auto p-1 bd-highlight">{{ $ipotscheduledlist->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Show Modal -->
    @include('livewire.admin.operationtheatre.othistory.show')
</div>
