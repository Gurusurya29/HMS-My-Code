<div class="position-relative">
    <label for="product" class="form-label">Search Product Code / Name </label>
    <span {{ $required ? '' : 'hidden' }} class="text-danger fw-bold">*</span>
    <input autocomplete="off" type="text" class="form-control" id="product" placeholder="Search Product ..."
           wire:model="product" wire:keydown.escape="resetData" wire:keydown.arrow-up=" decrementHighlight"
           wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="selectProduct"
           wire:keydown.tab='selectProduct' />
    @if (!empty($product))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetData"></div>
        <div class="position-absolute bg-white rounded-t-none shadow-lg list-group" style="width:99%; z-index: 50;">
            @if ($isrproductselected === false)
                @if (!empty($pharmacyproductlist))
                    @foreach ($pharmacyproductlist as $i => $eachpharmacyproduct)
                        <div type="button"
                             wire:click='selecthisproduct({{ $eachpharmacyproduct->id }},{{ "'" . $eachpharmacyproduct->name . "'" }})'
                             class="search-option-list list-item p-1 text-xs {{ $highlightIndex === $i ? 'theme_bg_color' : '' }}">
                            {{ $eachpharmacyproduct->name }}
                            {{ $eachpharmacyproduct->pharmacygenaricname ? ' -' . $eachpharmacyproduct->pharmacygenaricname->name : '' }}
                            {{ $eachpharmacyproduct->pharmacymanufacturename ? '-' . $eachpharmacyproduct->pharmacymanufacturename->name : '' }}
                        </div>
                    @endforeach
                @else
                    <div class="list-item p-1">No results!</div>
                @endif
            @endif
        </div>
    @endif
</div>
