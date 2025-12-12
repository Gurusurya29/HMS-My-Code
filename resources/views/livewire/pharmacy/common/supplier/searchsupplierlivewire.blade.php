<div class="position-relative">
    <label for="po" class="form-label">SUPPLIER COMPANY NAME</label>
    <span class="text-danger fw-bold">*</span>
    <input autocomplete="off" type="text" class="form-control" id="supplier" placeholder="Search Supplier Company..."
        wire:model="supplier" wire:keydown.escape="resetData" wire:keydown.arrow-up="decrementHighlight"
        wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="selectSupplier" />
    @if (!empty($supplier))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
        <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:99%; z-index: 5000;">
            @if ($issupplierselected === false)
                @if (count($supplierlist) > 0)
                    @foreach ($supplierlist as $i => $eachsupplier)
                        <div type="button"
                            wire:click='selecthissupplier({{ $eachsupplier->id }},{{ "'" . $eachsupplier->company_name . "'" }})'
                            class="search-option-list list-item p-1 text-sm {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                            {{ $eachsupplier->uniqid }} - {{ $eachsupplier->company_name }} -
                            {{ $eachsupplier->contact_mobile_no }}</div>
                    @endforeach
                @else
                    <div class="list-item p-1">No results!</div>
                @endif
            @endif
        </div>
    @endif
</div>
