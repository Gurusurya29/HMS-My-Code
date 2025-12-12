<div class="position-relative">
    <label for="prescription" class="form-label">PRESCRIPTION</label>
    <input autocomplete="off" type="text" class="form-control" id="prescription" placeholder="Search Prescription ..."
        wire:model="prescription" wire:keydown.escape="resetData" wire:keydown.arrow-up="decrementHighlight"
        wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="selectPrescription" {{ $fromhms ? 'readonly'
        : '' }} />
    @if (!empty($prescription))
    <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
    <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:99%; z-index: 50;">
        @if ($isprescriptionselected === false)
        @foreach ($pharmprescriptionlist as $i => $eachpharmacyprescription)
        <div type="button"
            wire:click='selecthisprescription("{{ $eachpharmacyprescription->id }}","{{ $eachpharmacyprescription->uniqid }}")'
            class="search-option-list list-item p-1 text-xs {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
            {{ $eachpharmacyprescription->uniqid }}
        </div>
        @endforeach
        @endif
    </div>
    @endif
</div>