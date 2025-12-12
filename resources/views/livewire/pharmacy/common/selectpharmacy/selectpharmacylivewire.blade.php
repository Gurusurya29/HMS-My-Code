<div>
    <select class="form-select form-select-sm bg-warning" wire:model="selectid" wire:change='handlechange'
        aria-label=".form-select-sm example">
        @foreach ($pharmacybranch as $value)
            <option value="{{ $value->id }}">{{ $value->branch_name }}</option>
        @endforeach
    </select>
</div>
