<div class="position-relative">
    <label for="batch" class="form-label">BATCH NUMBER</label>
    <span class="text-danger fw-bold">*</span>
    <input id="batch" autocomplete="off" type="text" class="form-control" id="batch" placeholder="Search Batch ..."
        wire:model="batch" wire:keydown.escape="resetData" wire:keydown.arrow-up="decrementHighlight"
        wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="selectBatch" wire:keydown.tab="selectBatch" />
    {{-- @if (!empty($batch)) --}}
    <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
    <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:99%; z-index: 50;">
        @if ($isbatchselected === false)
            {{-- @if (count($batchlist) > 0) --}}
            @foreach ($batchlist as $i => $eachbatch)
                <div type="button"
                    wire:click='selecthisbatch({{ $eachbatch->id }}, {{ "'" . $eachbatch->batch . "'" }}, {{ "'" . $eachbatch->quantity . "'" }}, {{ "'" . $eachbatch->expiry_date . "'" }})'
                    class="d-flex p-2 justify-content-evenly search-option-list list-item p-1 fs-5 {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                    <span>{{ $eachbatch->batch }}</span>
                    <span>{{ 'Q-' . $eachbatch->quantity }}</span>
                    <span>{{ Carbon\Carbon::parse($eachbatch->expiry_date)->format('d-m-Y') }}</span>
                </div>
            @endforeach
            {{-- @else
                <div class="list-item p-1">No results!</div>
            @endif --}}
        @endif
    </div>
    {{-- @endif --}}
</div>
