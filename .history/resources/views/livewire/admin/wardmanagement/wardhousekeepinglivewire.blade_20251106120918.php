<div class="mt-3">
    @foreach ($wardtype as $type)
        <nav class="navbar navbar-dark theme_bg_color text-white">
            <div class="container-fluid">
                {{ $type->name }}
            </div>
        </nav>
        <div class="container">
            <div class="row">
                @forelse ($bedorroom->where('wardtype_id', $type->id)->all() as $eachroom)
                    @if ($eachroom->is_available == 0)
                        <a href="#" wire:click="housekeepingdata({{ $eachroom->id }}, 'MOVE TO HOUSEKEEPING')"
                            class="col-sm-1 p-1 text-decoration-none" data-bs-toggle="modal" data-bs-target="#myModal">
                            <div class="card m-1 bg-success text-white roomblock" id="{{ $eachroom->name }}">
                                <div class="card-body text-center" style="padding:  0.3rem;">
                                    <i class="bi bi-align-start " style="font-size: 1.5rem;"></i>
                                    <hr class="p-0 m-0">
                                    <span> {{ $eachroom->name }} </span>
                                </div>
                            </div>
                        </a>
                    @elseif ($eachroom->is_available == 2)
                        <a href="#" wire:click="housekeepingdata({{ $eachroom->id }}, 'ROOM READY')"
                            class="col-sm-1 p-1 text-decoration-none" data-bs-toggle="modal" data-bs-target="#myModal">
                            <div class="card m-1 bg-warning text-dark roomblock" id="{{ $eachroom->name }}">
                                <div class="card-body text-center" style="padding:  0.3rem;">
                                    <i class="bi bi-align-start " style="font-size: 1.5rem;"></i>
                                    <hr class="p-0 m-0">
                                    <span> {{ $eachroom->name }} </span>
                                </div>
                            </div>
                        </a>
                    @endif
                @empty
                    <p class="text-center">--</p>
                @endforelse
            </div>
        </div>
    @endforeach





    <!-- The Modal To Block Room -->
    <div wire:ignore.self class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="savehousekeeping" autocomplete="off">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $modaltitle }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input wire:model.lazy="password" type="password" class="form-control"
                                placeholder="Enter password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($modaltitle != 'MOVE TO HOUSEKEEPING')
                            <div class="mb-3 mt-3">
                                <label for="comment">Comments:</label>
                                <textarea wire:model="note" class="form-control" rows="4" name="text"></textarea>
                                @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        @include('admin.common.formsubmitbtnhelper.formsubmitbtnhelper', [
                            'method_name' => 'savehousekeeping',
                            'model_id' => '',
                        ])
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <br>
    <hr>
    <div>
        <x-admin.layouts.adminindex>

            <x-slot name="title">
                HOUSE KEEPING HISTORY
            </x-slot>

            <x-slot name="action">

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
                    'name' => 'ROOM NUMBER',
                    'type' => 'sortby',
                    'sortname' => 'roomnumber',
                ])

                @include('helper.tablehelper.tableheader', [
                    'name' => 'DONE BY',
                    'type' => 'normal',
                    'sortname' => '',
                ])
                @include('helper.tablehelper.tableheader', [
                    'name' => 'DETAILS',
                    'type' => 'sortby',
                    'sortname' => 'note',
                ])
                @include('helper.tablehelper.tableheader', [
                    'name' => 'CREATED AT ',
                    'type' => 'sortby',
                    'sortname' => 'created_at',
                ])

            </x-slot>

            <x-slot name="tablebody">
                @foreach ($housekeepinghistory as $index => $eachhousekeepinghistory)
                    <tr>
                        <td>{{ $housekeepinghistory->firstItem() + $index }}</td>
                        <td>{{ $eachhousekeepinghistory->uniqid }} </td>
                        <td class="text-center">{{ $eachhousekeepinghistory->roomnumber }} </td>
                        <td class="text-center">
                            {{ $eachhousekeepinghistory->creatable->name }} </td>
                        <td class="text-center"> {{ $eachhousekeepinghistory->note }} </td>
                        <td>{{ $eachhousekeepinghistory->created_at->format('d-m-Y h:i A') }}</td>
                    </tr>
                @endforeach
            </x-slot>

            <x-slot name="tablerecordtotal">
                Showing {{ $housekeepinghistory->firstItem() }} to {{ $housekeepinghistory->lastItem() }} out
                of
                {{ $housekeepinghistory->total() }}
                items
            </x-slot>

            <x-slot name="pagination">
                {{ $housekeepinghistory->links() }}
            </x-slot>

        </x-admin.layouts.adminindex>

    </div>


</div>
