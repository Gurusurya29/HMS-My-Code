<!-- <div wire:loading wire:target="{{ $method_name }}">
    <button class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span>
        Loading...
    </button>
</div>
<button wire:loading.remove type="submit" id="submit" wire:target="{{ $method_name }}"
    class="btn btn-primary">{{ $model_id ? 'Update' : 'Save' }}</button> -->

<button
    wire:click="{{ $method_name }}"
    wire:loading.remove
    wire:target="{{ $method_name }}"
    type="submit"
    id="submit"
    class="btn btn-primary">
    {{ $model_id ? 'Update' : 'Save11' }}
</button>

<div
    wire:loading
    wire:target="{{ $method_name }}"
    style="display: none;">
    <button class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span>
        Loading...
    </button>
</div>