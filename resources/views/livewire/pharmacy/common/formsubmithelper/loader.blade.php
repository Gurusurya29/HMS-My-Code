<div wire:loading wire:target="{{ $target }}" class="mt-2">
    <div class="spinner-border loadingspinner {{ isset($class) ? $class : '' }}" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
