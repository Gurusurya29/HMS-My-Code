<div>
    <div class="card shadow-sm">
        <div class="card-header text-white theme_bg_color">
            <div class="d-flex flex-row bd-highlight">
                <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">INVESTIGATION GROUP</span></div>
                <div class="bd-highlight">
                    <a class="btn btn-sm btn-secondary shadow float-end mx-1"
                        href="{{ $this->currentuser()->usertype == 'ADMIN' ? route('settings') : route('laboratorysettings') }}"
                        role="button">Back</a>
                    <button wire:click="create" type="button" class="btn btn-sm btn-primary shadow float-end mx-1"
                        data-bs-toggle="modal" data-bs-target="#createoreditModal">
                        Add
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
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
                <div class="mb-2 col-md-8 row">
                    <div class="row col-auto">
                        <label for="investigationtypeid" class="col-auto col-form-label fw-bold">Investigation Type
                            :</label>
                        <div class="col-auto">
                            <select class="form-select" wire:model.lazy="investigationtype" id="investigationtypeid">
                                <option selected>Select Investigation Type</option>
                                @foreach (config('archive.labinvestigationtype') as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-auto d-flex">
                        <input wire:model="searchTerm" type="text" class="form-control bg-white"
                            placeholder="Search...">
                        <button wire:click="clear" class="btn btn-sm btn-secondary mx-2"> Clear</button>
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
                                'name' => 'UNIQID',
                                'type' => 'sortby',
                                'sortname' => 'uniqid',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'NAME',
                                'type' => 'sortby',
                                'sortname' => 'name',
                            ])
                            @include('helper.tablehelper.tableheader', [
                                'name' => 'INVESTIGATION TYPE',
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
                        @foreach ($labinvestigationgroup as $index => $eachlabinvestigationgroup)
                            <tr>
                                <td>{{ $labinvestigationgroup->firstItem() + $index }}</td>
                                <td>{{ $eachlabinvestigationgroup->uniqid }}</td>
                                <td class="text-center">{{ $eachlabinvestigationgroup->name }}</td>
                                <td class="text-center">
                                    {{ config('archive.labinvestigationtype')[$eachlabinvestigationgroup->labinvestigationtype] }}
                                </td>
                                <td>
                                    @include('admin.common.datatable.activestatus', [
                                        'status' => $eachlabinvestigationgroup->active,
                                    ])
                                </td>
                                <td>
                                    <button wire:click="show({{ $eachlabinvestigationgroup->id }})"
                                        class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></button>

                                    <button wire:click="edit({{ $eachlabinvestigationgroup->id }})"
                                        class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex bd-highlight">
                    <div class="p-1 bd-highlight">
                        Showing {{ $labinvestigationgroup->firstItem() }} to
                        {{ $labinvestigationgroup->lastItem() }} out of
                        {{ $labinvestigationgroup->total() }} items
                    </div>
                    <div class="ms-auto p-1 bd-highlight">{{ $labinvestigationgroup->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create or Edit Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labinvestigationgroup.createoredit')

    <!-- Show Modal -->
    @include('livewire.laboratory.settings.laboratorymaster.labinvestigationgroup.show')

</div>
