<div class="card-body bg-light">
    @include('livewire.admin.inpatient.common.inpatientregistrationdetails')
    <div>
        <div class="card shadow-sm">
            <div class="card-header text-white theme_bg_color py-1 px-2">
                <div class="d-flex flex-row bd-highlight align-items-center">
                    <div class="flex-grow-1 bd-highlight">PATIENT TRANSFER HISTORY</div>
                    <div class="bd-highlight d-flex gap-1">
                        <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                            data-bs-toggle="modal" data-bs-target="#createoreditModal">
                            Transfer
                        </button>
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
                    {{-- <div class="mb-2 col-md-3 float-end">
                        <input wire:model="searchTerm" type="text" class="form-control bg-white"
                            placeholder="Search...">
                    </div> --}}
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
                                    'name' => 'PREVIOUS WARD',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'CHANGED WARD',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'CHANGED ON',
                                    'type' => 'normal',
                                    'sortname' => '',
                                ])
                                @include('helper.tablehelper.tableheader', [
                                    'name' => 'CHANGED BY',
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
                            @foreach ($ippatienttransferlist as $index => $eachippatienttransfer)
                                <tr>
                                    <td>{{ $ippatienttransferlist->firstItem() + $index }}</td>
                                    <td>{{ $eachippatienttransfer->uniqid }}</td>
                                    <td>{{ $eachippatienttransfer->previousroom_name }}</td>
                                    <td>{{ $eachippatienttransfer->changedroom_name }}</td>
                                    <td>{{ $eachippatienttransfer->created_at->format('d-m-Y h:i A') }}</td>
                                    <td>{{ $eachippatienttransfer->creatable->name }}</td>
                                    <td>
                                        <button wire:click="show({{ $eachippatienttransfer->id }})"
                                            class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="d-flex bd-highlight">
                        <div class="p-1 bd-highlight"> Showing {{ $ippatienttransferlist->firstItem() }} to
                            {{ $ippatienttransferlist->lastItem() }} out
                            of
                            {{ $ippatienttransferlist->total() }} items</div>
                        <div class="ms-auto p-1 bd-highlight"> {{ $ippatienttransferlist->links() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create or Edit Modal -->
        @include('livewire.admin.inpatient.ipnursingstation.ippatienttransfer.createoredit')

        <!-- Show Modal -->
        @include('livewire.admin.inpatient.ipnursingstation.ippatienttransfer.show')

    </div>

</div>
