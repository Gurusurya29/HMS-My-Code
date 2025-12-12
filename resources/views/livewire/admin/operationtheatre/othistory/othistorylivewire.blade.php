<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5"> OT HISTORY</span></div>
                <div class="bd-highlight d-flex gap-1">

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
                                'type' => 'normal',
                                'sortname' => '',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'PATIENT NAME',
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
                            @can('OT-Historyview')
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'VIEW',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($othistory as $index => $eachothistory)
                            <tr>
                                <td>{{ $othistory->firstItem() + $index }}</td>
                                <td>{{ $eachothistory->patient->uhid }}</td>
                                <td>{{ $eachothistory->patient->name }}</td>
                                <td>{{ $eachothistory->surgery_name }}</td>
                                <td>{{ $eachothistory->surgery_startdate ? date('d-m-Y h:i A', strtotime($eachothistory->surgery_startdate)) : '-' }}
                                </td>
                                <td>{{ $eachothistory->surgery_enddate ? date('d-m-Y h:i A', strtotime($eachothistory->surgery_enddate)) : '-' }}
                                </td>
                                <td>
                                    @if ($eachothistory->is_movetoip)
                                        <div class="text-primary fw-bold fs-5">
                                            Completed
                                        </div>
                                    @else
                                        @include('admin.common.datatable.activestatus', [
                                            'status' => $eachothistory->is_otactive,
                                        ])
                                    @endif
                                </td>
                                @can('OT-Historyview')
                                    <td>
                                        <button wire:click="show({{ $eachothistory->id }})"
                                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="d-flex bd-highlight">
                    <div class="p-1 bd-highlight"> Showing {{ $othistory->firstItem() }} to
                        {{ $othistory->lastItem() }} out of
                        {{ $othistory->total() }} items</div>
                    <div class="ms-auto p-1 bd-highlight"> {{ $othistory->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.operationtheatre.othistory.show')
</div>
