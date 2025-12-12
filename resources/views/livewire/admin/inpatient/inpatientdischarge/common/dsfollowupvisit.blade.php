<div class="col-md-12 card border-0">
    <div class="card-title fs-5 fw-bold">Follow Up Visits</div>

    <div class="card-body">
        <table class="table table-striped">
            @if ($followupvisit)
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>DEPARTMENT</th>
                        <th>NOTE</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($followupvisit as $key => $eachfollowupvisit)
                        <tr>
                            <th>
                                <input type="date" wire:model="followupvisit.{{ $key }}.scheduledate"
                                    class="form-control">
                                @error('followupvisit.' . $key . '.scheduledate')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </th>
                            <th>
                                <input type="text" wire:model="followupvisit.{{ $key }}.department"
                                    class="form-control">
                                @error('followupvisit.' . $key . '.department')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </th>
                            <th>
                                <input type="textarea" wire:model="followupvisit.{{ $key }}.additionalnote"
                                    class="form-control">
                                @error('followupvisit.' . $key . '.additionalnote')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </th>
                            <th>
                                @if ($loop->last)
                                    <button type="button" wire:click.prevent="addfollowup"
                                        class="table-add_line btn btn-sm btn-success mx-1"><i
                                            class="bi bi-plus-lg"></i></button>
                                @endif
                                @if (sizeof($followupvisit) > 1)
                                    <button type="button"
                                        wire:click.prevent="removelineitem({{ $key }}, 'followup')"
                                        class="table-remove-btn btn btn-sm btn-danger mx-1"><i
                                            class="bi bi-trash-fill"></i></button>
                                @endif
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>
</div>
